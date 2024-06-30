using System;
using System.Data;
using System.Windows.Forms;
using Dapper;
using MySql.Data.MySqlClient;
using System.Security.Cryptography;
using System.Text;

namespace Kuis3
{
    public partial class RegistrationForm : Form
    {
        private Database db = new Database();
        public RegistrationForm()
        {
            InitializeComponent();
            txtPassword.UseSystemPasswordChar = true;
        }

        private void btrRegister_Click(object sender, EventArgs e)
        {
            string email = txtEmail.Text;
            string password = txtPassword.Text;
            string role = cmbRole.SelectedItem.ToString();

            string passwordHash = HashPassword(txtPassword.Text);
            string encryptedEmail = EncryptEmail(email);

            using (var connection = db.GetConnection())
            {
                connection.Execute("INSERT INTO users (email, password_hash, role) VALUES (@Email, @PasswordHash, @Role)", new
                {
                    Email = encryptedEmail,
                    PasswordHash = passwordHash,
                    Role = role
                });
            }

            MessageBox.Show("User registered successfully!");

            Console.WriteLine($"Encrypted Email: {encryptedEmail}");
            Console.WriteLine($"Password Hash: {passwordHash}");
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

        private void RegistrationForm_Load_1(object sender, EventArgs e)
        {
            cmbRole.Items.Add("Admin");
            cmbRole.Items.Add("Kasir");
        }

        private void button2_Click(object sender, EventArgs e)
        {
            AdminForm adminForm = new AdminForm();
            adminForm.Show();
            this.Hide();
        }
    }
}
