using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Dapper;
using iText.Kernel.Pdf;
using iText.Layout.Element;
using iText.Layout;
using iText.Layout.Properties;
using MySql.Data.MySqlClient;

namespace Kuis3
{
    public partial class AdminForm : Form
    {
        private Database db = new Database();
        public AdminForm()
        {
            InitializeComponent();
            LoadProducts();
        }

        private void LoadProducts()
        {
            using (var connection = db.GetConnection())
            {
                var products = connection.Query<Product>("SELECT * FROM products").ToList();
                dataGridViewProducts.DataSource = products;
            }
        }

        private void btnAddProduct_Click(object sender, EventArgs e)
        {
            try
            {
                if (string.IsNullOrWhiteSpace(txtProductName.Text))
                {
                    MessageBox.Show("Masukkan Nama Produk.");
                    return;
                }

                if (!int.TryParse(numericUpDown1.Value.ToString(), out int stock) || stock <= 0)
                {
                    MessageBox.Show("Masukkan Jumlah Stok.");
                    return;
                }

                if (!decimal.TryParse(txtProductPrice.Text, out decimal price) || price <= 0)
                {
                    MessageBox.Show("Masukkan Harga yang Sesuai.");
                    return;
                }

                using (var connection = db.GetConnection())
                {
                    var product = new Product { Name = txtProductName.Text, Stock = stock, Price = price };
                    connection.Execute("INSERT INTO products (name, Stock, price) VALUES (@Name, @Stock, @Price)", product);
                    LoadProducts();
                }
            }
            catch (Exception ex)
            {
                MessageBox.Show($"An error occurred: {ex.Message}");
            }
        }

        private void btnEditProduct_Click(object sender, EventArgs e)
        {
            if (dataGridViewProducts.SelectedRows.Count > 0)
            {
                var selectedRow = dataGridViewProducts.SelectedRows[0];
                string selectedId = selectedRow.Cells["Id"].Value.ToString();

                string newName = txtProductName.Text;
                int newStock = int.Parse(numericUpDown1.Text);
                decimal newPrice = decimal.Parse(txtProductPrice.Text);

                using (var connection = db.GetConnection())
                {
                    connection.Execute("UPDATE products SET name = @Name, Stock = @Stock, price = @Price WHERE Id = @Id", new { Name = newName, Stock = newStock, Price = newPrice, Id = selectedId });
                    LoadProducts();
                }
            }
            else
            {
                MessageBox.Show("Please select a row to edit.");
            }
        }

        private void btnDeleteProduct_Click(object sender, EventArgs e)
        {
            if (dataGridViewProducts.SelectedRows.Count > 0)
            {
                var selectedRow = dataGridViewProducts.SelectedRows[0];
                string selectedNama = selectedRow.Cells["Name"].Value.ToString();

                using (var connection = db.GetConnection())
                {
                    connection.Execute("DELETE FROM products WHERE name = @Name", new { Name = selectedNama });
                    LoadProducts();
                }
            }
            else
            {
                MessageBox.Show("Please select a row to delete.");
            }
        }

        private void btnGenerateReport_Click(object sender, EventArgs e)
        {
            using (var connection = db.GetConnection())
            {
                var sales = connection.Query<Sale>("SELECT * FROM sales").ToList();

                SaveFileDialog saveFileDialog = new SaveFileDialog();
                saveFileDialog.Filter = "PDF files (.pdf)|.pdf";
                saveFileDialog.Title = "Save an PDF File";
                if (saveFileDialog.ShowDialog() == DialogResult.OK)
                {
                    string filePath = saveFileDialog.FileName;
                    CreatePdf(sales, filePath);
                    MessageBox.Show("PDF berhasil dibuat di " + filePath);
                }
            }
        }

        private void CreatePdf(IEnumerable<Sale> products, string filePath)
        {
            using (PdfWriter writer = new PdfWriter(filePath))
            {
                using (PdfDocument pdf = new PdfDocument(writer))
                {
                    Document document = new Document(pdf);

                    document.Add(new Paragraph("Daftar Produk yang telah Terjual")
                        .SetTextAlignment(TextAlignment.CENTER)
                        .SetFontSize(20));

                    Table table = new Table(new float[] { 1, 4, 3, 2 });
                    table.SetWidth(UnitValue.CreatePercentValue(100));

                    table.AddHeaderCell("ID");
                    table.AddHeaderCell("Nama");
                    table.AddHeaderCell("Jumlah");
                    table.AddHeaderCell("Total");

                    foreach (var sales in products)
                    {
                        table.AddCell(sales.Id.ToString());
                        table.AddCell(sales.Product_Name);
                        table.AddCell(sales.Quantity.ToString());
                        table.AddCell(sales.Total.ToString("C"));
                    }

                    document.Add(table);
                    document.Close();
                }
            }
        }

        private void dataGridViewProducts_SelectionChanged(object sender, EventArgs e)
        {
            if (dataGridViewProducts.SelectedRows.Count > 0)
            {
                var selectedRow = dataGridViewProducts.SelectedRows[0];
                txtProductName.Text = selectedRow.Cells["Name"].Value.ToString();
                numericUpDown1.Text = selectedRow.Cells["Stock"].Value.ToString();
                txtProductPrice.Text = selectedRow.Cells["Price"].Value.ToString();
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            RegistrationForm registrationForm = new RegistrationForm();
            registrationForm.Show();
            this.Hide();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            Form1 form = new Form1();
            form.Show();
            this.Hide();
        }

    }
}
