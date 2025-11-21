<template>
  <div class="asset-manager">
    <h2 class="title">Asset Management</h2>
    
    <!-- ฟอร์มเพิ่มอุปกรณ์ -->
    <form @submit.prevent="addAsset" class="asset-form">
      <h3>Add New Asset</h3>
      <div class="form-group">
        <label for="asset_code">Asset Code:</label>
        <input v-model="newAsset.asset_code" id="asset_code" placeholder="Asset Code" required />
      </div>
      
      <div class="form-group">
        <label for="asset_name">Asset Name:</label>
        <input v-model="newAsset.asset_name" id="asset_name" placeholder="Asset Name" required />
      </div>
      
      <div class="form-group">
        <label for="category_id">Category:</label>
        <select v-model="newAsset.category_id" id="category_id" required>
          <option v-for="category in categories" :key="category.category_id" :value="category.category_id">{{ category.category_name }}</option>
        </select>
      </div>

      <div class="form-group">
        <label for="purchase_date">Purchase Date:</label>
        <input v-model="newAsset.purchase_date" id="purchase_date" type="date" required />
      </div>

      <div class="form-group">
        <label for="price">Price:</label>
        <input v-model="newAsset.price" id="price" type="number" placeholder="Price" required />
      </div>

      <div class="form-group">
        <label for="image">Image URL:</label>
        <input v-model="newAsset.image" id="image" placeholder="Image URL" required />
      </div>

      <button type="submit" class="btn-submit">Add Asset</button>
    </form>

    <!-- แสดงข้อมูลอุปกรณ์ -->
    <h3>Asset List</h3>
    <table class="asset-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Code</th>
          <th>Name</th>
          <th>Category</th>
          <th>Price</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="asset in assets" :key="asset.asset_id">
          <td>{{ asset.asset_id }}</td>
          <td>{{ asset.asset_code }}</td>
          <td>{{ asset.asset_name }}</td>
          <td>{{ asset.category_name }}</td>
          <td>{{ asset.price | currency }}</td>
          <td>
            <button @click="deleteAsset(asset.asset_id)" class="btn-delete">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      assets: [],
      categories: [],
      newAsset: {
        asset_code: '',
        asset_name: '',
        category_id: '',
        purchase_date: '',
        price: '',
        image: ''
      }
    };
  },
  mounted() {
    this.fetchAssets();
    this.fetchCategories();
  },
  methods: {
    async fetchAssets() {
      try {
        const response = await axios.get('http://localhost:8081/asset/api_php/get_assets.php');
        this.assets = response.data;
      } catch (error) {
        console.error("Error fetching assets:", error);
      }
    },
    async fetchCategories() {
      try {
        const response = await axios.get('http://localhost:8081/asset/api_php/get_categories.php');
        this.categories = response.data;
      } catch (error) {
        console.error("Error fetching categories:", error);
      }
    },
    async addAsset() {
      try {
        const response = await axios.post('http://localhost:8081/asset/api_php/add_asset.php', this.newAsset);
        alert(response.data.message);
        this.fetchAssets();
      } catch (error) {
        console.error("Error adding asset:", error);
      }
    },
    async deleteAsset(asset_id) {
      try {
        const response = await axios.post('http://localhost:8081/asset/api_php/delete_asset.php', { asset_id });
        alert(response.data.message);
        this.fetchAssets();
      } catch (error) {
        console.error("Error deleting asset:", error);
      }
    }
  }
};
</script>

<style scoped>
/* ทั่วไป */
.asset-manager {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f8f9fa;
  border-radius: 8px;
}

h2.title {
  text-align: center;
  color: #2c3e50;
  font-size: 2rem;
  margin-bottom: 20px;
}

h3 {
  margin-bottom: 15px;
  color: #34495e;
}

/* ฟอร์ม */
.asset-form {
  background-color: #ffffff;
  border-radius: 8px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.asset-form .form-group {
  margin-bottom: 15px;
}

.asset-form .form-group label {
  font-weight: bold;
  display: block;
  margin-bottom: 5px;
}

.asset-form input, .asset-form select {
  width: 100%;
  padding: 10px;
  border-radius: 4px;
  border: 1px solid #ddd;
  font-size: 16px;
}

.asset-form input:focus, .asset-form select:focus {
  outline: none;
  border-color: #f39c12;
}

.btn-submit {
  background-color: #f39c12;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-size: 16px;
  width: 100%;
  margin-top: 15px;
}

.btn-submit:hover {
  background-color: #e67e22;
}

/* ตาราง */
.asset-table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background-color: #ffffff;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.asset-table th, .asset-table td {
  padding: 12px;
  text-align: left;
  border: 1px solid #ddd;
}

.asset-table th {
  background-color: #34495e;
  color: white;
}

.asset-table tr:nth-child(even) {
  background-color: #f9f9f9;
}

.asset-table tr:hover {
  background-color: #f1f1f1;
}

.btn-delete {
  background-color: #e74c3c;
  color: white;
  border: none;
  padding: 8px 12px;
  border-radius: 4px;
  cursor: pointer;
}

.btn-delete:hover {
  background-color: #c0392b;
}

/* เพิ่มสีให้กรอกข้อมูล */
.asset-form input:focus {
  border-color: #3498db;
}
</style>
