<template>
  <div>
    <select
      name="access"
      @change="$emit('changeData', access1);"
      v-model="access1"
      id="access"
    >
      <option :value="item['id']" v-for="(item, key) in schools" :key="key">
        {{ item["name"] }}
      </option>
    </select>
  </div>
</template>
<script>
import { sendRequest } from "@/script/private/API-Request";
export default {
  name: "SeelectAccess",
  created() {
    this.access1 = null;
    this.getSchools();
  },
  data() {
    return {
      access1: "",
      schools: "",
    };
  },
  methods: {
    async getSchools() {
      const apiUrl = "http://localhost/api/api.php";
      const data = await {
        type: "listschool",
      };
      let response = await sendRequest(apiUrl, data);
      let responseBody = await response.text();
      let jsonData = await JSON.parse(responseBody);
      this.schools = jsonData[0];
    },
  },
};
</script>
<style scoped>
select {
  width: 60%;
  border-radius: 10px;
  background: #d9d9d9;
  box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);
  border: none;
  padding: 2% 4%;
}
</style>
