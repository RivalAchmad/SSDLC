using Dapper;
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

namespace Kuis3
{
    public partial class KasirForm : Form
    {
        private Database db = new Database();
        private BindingList<SaleItem> cartItems = new BindingList<SaleItem>();

        public KasirForm()
        {
            InitializeComponent();
            LoadProducts();
            dataGridViewCart.DataSource = cartItems;
        }

        private void LoadProducts()
        {
            using (var connection = db.GetConnection())
            {
                var products = connection.Query<Product>("SELECT * FROM products").ToList();
                comboBoxProducts.DataSource = products;
                comboBoxProducts.DisplayMember = "Name";
                comboBoxProducts.ValueMember = "Id";
            }
        }

        private void btnAddToCart_Click(object sender, EventArgs e)
        {
            var selectedProduct = comboBoxProducts.SelectedItem as Product;
            if (selectedProduct != null && int.Parse(numericUpDown1.Text) != 0)
            {
                using (var connection = db.GetConnection())
                {
                    var productInDb = connection.QuerySingleOrDefault<Product>("SELECT * FROM products WHERE Id = @Id", new { Id = selectedProduct.Id });
                    if (productInDb != null && productInDb.Stock >= int.Parse(numericUpDown1.Text))
                    {
                        var quantity = int.Parse(numericUpDown1.Text);
                        var total = selectedProduct.Price * quantity;

                        cartItems.Add(new SaleItem
                        {
                            ProductId = selectedProduct.Id,
                            ProductName = selectedProduct.Name,
                            Quantity = quantity,
                            Total = total
                        });
                    }
                    else
                    {
                        MessageBox.Show("Not enough stock for this product.");
                    }
                }
            }
            else
            {
                MessageBox.Show("Masukkan jumlah barang.");
            }
        }

        private void btnCheckout_Click(object sender, EventArgs e)
        {
            if (cartItems == null || cartItems.Count == 0)
            {
                MessageBox.Show("Tidak ada barang di keranjang");
                return;
            }

            using (var connection = db.GetConnection())
            {
                connection.Open();
                using (var transaction = connection.BeginTransaction())
                {
                    try
                    {
                        foreach (var item in cartItems)
                        {
                            var product = connection.QuerySingleOrDefault<Product>("SELECT * FROM products WHERE Id = @Id", new { Id = item.ProductId }, transaction);
                            if (product != null && product.Stock >= item.Quantity)
                            {
                                product.Stock -= item.Quantity;
                                connection.Execute("UPDATE products SET Stock = @Stock WHERE Id = @Id", new { Stock = product.Stock, Id = product.Id }, transaction);

                                connection.Execute("INSERT INTO sales (Product_Name, Quantity, Total) VALUES (@ProductName, @Quantity, @Total)",
                                    new { ProductName = item.ProductName, Quantity = item.Quantity, Total = item.Total }, transaction);
                            }
                            else
                            {
                                throw new Exception($"Not enough stock for product: {item.ProductName}");
                            }
                        }

                        transaction.Commit();
                        MessageBox.Show("Checkout successful.");
                        cartItems.Clear();
                    }
                    catch (Exception ex)
                    {
                        transaction.Rollback();
                        MessageBox.Show($"Checkout failed: {ex.Message}");
                    }
                }
            }
        }

        private void button2_Click_1(object sender, EventArgs e)
        {
            Form1 form = new Form1();
            form.Show();
            this.Hide();
        }
    }

    public class SaleItem
    {
        public int ProductId { get; set; }
        public string ProductName { get; set; }
        public int Quantity { get; set; }
        public decimal Total { get; set; }
    }
}
