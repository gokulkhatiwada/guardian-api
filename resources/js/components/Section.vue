<template>
  <div v-if="loading">Loading</div>
  <div v-if="error">{{ error }}</div>
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-12 mb-3" v-for="section in sections">
      <div class="card">
        <div class="card-body">
          <router-link :to="{name:'category',params:{category:section.id}}">{{ section.webTitle}}</router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Section",
  data(){
    return {
      sections: [],
      loading: true,
      error: ''
    }
  },
  methods: {
    getAllSections(){
      axios.get('/api/sections')
      .then(response=>{
        this.loading = false;
        this.sections = response.data
      })
      .catch(error=>{
        this.loading = false;
        this.error = error.response.data;
      })
    }
  },
  mounted(){
  this.getAllSections();
  }
}
</script>

<style scoped>

</style>