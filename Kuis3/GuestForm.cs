using System;
using System.Collections.Generic;
using System.Linq;
using System.Data;
using System.Windows.Forms;
using Dapper;

namespace Kuis3
{
    public partial class GuestForm : Form
    {
        private List<Product> allProducts;

        private Database db = new Database();
        public GuestForm()
        {
            InitializeComponent();
            LoadProducts();
        }
        private void LoadProducts()
        {
            using (var connection = db.GetConnection())
            {
                allProducts = connection.Query<Product>("SELECT * FROM products").ToList();
                DisplayProducts(allProducts);
            }
        }

        private void DisplayProducts(List<Product> products)
        {
            dataGridView1.DataSource = products;
        }

        private void txtSearch_TextChanged(object sender, EventArgs e)
        {
            FilterProducts();
        }

        private void FilterProducts()
        {
            var filteredProducts = allProducts.Where(p =>
                p.Name.IndexOf(txtSearch.Text, StringComparison.OrdinalIgnoreCase) >= 0).ToList();


            filteredProducts = filteredProducts.OrderBy(p => p.Name).ToList();


            DisplayProducts(filteredProducts);
        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {
            using (var connection = db.GetConnection())
            {
                var sortOption = comboBox1.SelectedItem.ToString();
                string query = "SELECT * FROM products";

                if (sortOption == "Name")
                    query += " ORDER BY name";
                if (sortOption == "Stock")
                    query += " ORDER BY Stock";
                else if (sortOption == "Price")
                    query += " ORDER BY price";

                var products = connection.Query<Product>(query).ToList();
                dataGridView1.DataSource = products;
            }
        }

        private void GuestForm_Load(object sender, EventArgs e)
        {
            comboBox1.Items.Add("Name");
            comboBox1.Items.Add("Price");
            comboBox1.Items.Add("Stock");
            comboBox1.SelectedIndex = 0;
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form1 form = new Form1();
            form.Show();
            this.Hide();
        }

    }
}
