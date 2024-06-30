using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using MySql.Data.MySqlClient;
using Dapper;
using Org.BouncyCastle.Crypto.Generators;
using System.Security.Cryptography;
using static System.Windows.Forms.VisualStyles.VisualStyleElement;


namespace Kuis3
{
    public partial class Form1 : Form
    {
        private Database db = new Database();
        public Form1()
        {
            InitializeComponent();
            txtPassword.UseSystemPasswordChar = true;
        }

        private void btnLogin_Click(object sender, EventArgs e)
        {
            using (var connection = db.GetConnection())
            {
                string query = "SELECT COUNT(1) FROM users WHERE email = @Email AND password_hash = @PasswordHash";

                var parameters = new { Email = EncryptEmail(txtEmail.Text), PasswordHash = HashPassword(txtPassword.Text) };
                int count = connection.ExecuteScalar<int>(query, parameters);

                if (count == 1)
                {
                    string roleQuery = "SELECT role FROM users WHERE email = @Email";
                    string role = connection.QuerySingle<string>(roleQuery, new { Email = EncryptEmail(txtEmail.Text) });

                    if (role == "admin")
                    {
                        AdminForm adminForm = new AdminForm();
                        adminForm.Show();
                    }
                    else if (role == "kasir")
                    {
                        KasirForm kasirForm = new KasirForm();
                        kasirForm.Show();
                    }
                    this.Hide();
                }
                else
                {
                    MessageBox.Show("Invalid email or password.");
                }
            }
        }
        private string EncryptEmail(string email)
        {
            byte[] emailBytes = System.Text.Encoding.UTF8.GetBytes(email);
            string encryptedEmail = Convert.ToBase64String(emailBytes);
            return encryptedEmail;
        }

        private string HashPassword(string password)
        {
            using (SHA256 sha256 = SHA256.Create())
            {
                byte[] bytes = sha256.ComputeHash(Encoding.UTF8.GetBytes(password));
                StringBuilder builder = new StringBuilder();
                foreach (byte b in bytes)
                {
                    builder.Append(b.ToString("x2"));
                }
                return builder.ToString();
            }
        }
        private void btnGuest_Click(object sender, EventArgs e)
        {
            GuestForm guestForm = new GuestForm();
            guestForm.Show();
            this.Hide();
        }
    }
}
