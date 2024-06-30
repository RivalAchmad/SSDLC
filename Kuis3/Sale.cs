using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Kuis3
{
    internal class Sale
    {
        public int Id { get; set; }
        public string Product_Name { get; set; }
        public int Stock { get; set; }
        public int Quantity { get; set; }
        public decimal Total { get; set; }
    }
}
