<template>
  <h1>This is job view</h1>
</template>

<script>
import axios from 'axios'

export default {
  name: 'JobView',
  data() {
    return {
      job: []
    }
  },
  methods: {
    async getJob() {
      let jobId = this.$route.query.id

      try {
        const response = await axios.post('http://localhost/Jobber/controller/JobController.php', {
          action: 'getJob',
          jobId: jobId
        })

        console.log(response.data)
        // Log the error into the console
      } catch (error) {
        console.error('Error:', error)
      }
    }
  },
  created() {
    this.getJob()
  }
}
</script>
