using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Data;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Kuis3
{
    internal class Database
    {
        private readonly string connectionString = "Server=localhost;Database=kuis3;Uid=root;Pwd=;";

        public IDbConnection GetConnection()
        {
            return new MySqlConnection(connectionString);
        }
    }
}
