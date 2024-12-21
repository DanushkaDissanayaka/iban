<template>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h3>International Bank Account Number</h3>
      </div>
    </div>
    <div class="active_table mt-3">
      <div class="table-responsive">
        <table class="table text-nowrap table-striped">
          <thead>
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>IBAN Number</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(ibanNumber, index) in ibanNumbers"
              :key="index"
              v-if="ibanNumbers.length"
            >
              <td>{{ ibanNumber.name }}</td>
              <td>{{ ibanNumber.email }}</td>
              <td>{{ ibanNumber.number }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <el-pagination background layout="prev, pager, next" :total="1000" />
    </div>
  </div>
</template>

<script>
export default {
  data: function () {
    return {
      ibanNumbers: [],
    };
  },
};
</script>
