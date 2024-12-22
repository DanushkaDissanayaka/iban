<template>
  <div>
    <div class="container mt-3">
      <div class="title-section">
    <h1>International Bank Account Number</h1>
    <p>Manage and search IBAN records</p>
</div>
      <div class="row">
        <el-input
          v-model="searchText"
          placeholder="Search by IBAN or User Name"
          class="search-box mb-4"
          @input="fetchData"
          clearable
        ></el-input>
      </div>

      <el-table :data="data" style="width: 100%">
        <el-table-column prop="user.name" label="User Name"></el-table-column>
        <el-table-column prop="number" label="IBAN Number"></el-table-column>
        <el-table-column
          prop="created_at"
          :formatter="formatDate"
          label="Recorded At"
        ></el-table-column>
      </el-table>
      <el-pagination
        background
        layout="prev, pager, next, jumper, ->, total"
        :current-page="currentPage"
        :page-size="perPage"
        :total="totalItems"
        @current-change="handlePageChange"
      ></el-pagination>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import moment from "moment";
export default {
  data() {
    return {
      data: [],
      currentPage: 1,
      perPage: 10,
      totalItems: 0,
      searchText: "",
    };
  },
  methods: {
    async fetchData(page = 1) {
      try {
        const response = await axios.get("/ibans", {
          params: {
            page,
            per_page: this.perPage,
            search_text: this.searchText,
          },
        });

        const { data, current_page, total_items, per_page } = response.data;

        this.data = data;
        this.currentPage = current_page;
        this.totalItems = total_items;
        this.perPage = +per_page;
      } catch (error) {
        console.error("Error fetching data:", error);
      }
    },
    handlePageChange(page) {
      this.currentPage = page;
      this.fetchData(page);
    },
    formatDate(row, column, cellValue) {
      if (!cellValue) return "-";
      return moment(cellValue).format("DD/MM/yyyy");
    },
  },
  mounted() {
    this.fetchData(); // Fetch initial data
  },
};
</script>

<style scoped>
/* General Page Styling */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 20px;
}

/* Header Styling */
h1 {
    text-align: center;
    color: #333;
    font-size: 24px;
    margin-bottom: 20px;
}
/* Search Input Styling */
.el-input {
    width: 50%;
    margin: 0 auto 20px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.el-input input {
    padding: 10px;
    font-size: 16px;
}

/* Table Styling */
.el-table {
    width: 80%;
    margin: 0 auto;
    border: 1px solid #ddd;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.el-table th {
    background-color: #007BFF;
    color: white;
    text-align: left;
    padding: 10px;
    font-size: 14px;
}

.el-table td {
    padding: 10px;
    font-size: 14px;
    color: #555;
    border-bottom: 1px solid #ddd;
}

.el-table tr:hover {
    background-color: #f1f1f1;
}

/* Pagination Styling */
.el-pagination {
    display: flex;
    justify-content: center;
    margin: 20px 0;
}

.el-pagination .el-pager li {
    margin: 0 5px;
    font-size: 14px;
}

.el-pagination .el-pager li.active {
    background-color: #007BFF;
    color: white;
    border-radius: 50%;
}

/* Title Section Styling */
.title-section {
    text-align: center;
    background-color: #007BFF;
    color: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.title-section h1 {
    font-size: 28px;
    margin: 0;
    font-weight: bold;
}

.title-section p {
    font-size: 16px;
    margin: 10px 0 0;
    color: #f1f1f1;
}

/* Footer Text */
footer {
    text-align: center;
    margin-top: 20px;
    color: #888;
    font-size: 12px;
}
</style>