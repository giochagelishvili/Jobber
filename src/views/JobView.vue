<template>
  <h1>This is job view</h1>
</template>

<script>
export default {
  name: 'JobView',
  data() {
    return {
      jobId: null
    }
  },
  created() {
    this.jobId = this.$route.query.id
    console.log(this.jobId)
  }
}
</script>
