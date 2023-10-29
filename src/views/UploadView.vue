<template>
  <header>
    <UploadHeader />
  </header>

  <main>
    <UploadMain />
  </main>
</template>

<script>
import UploadHeader from '../components/headers/UploadHeader.vue'
import UploadMain from '../components/mains/UploadMain.vue'

export default {
  name: 'UploadView',
  components: { UploadHeader, UploadMain }
}
</script>
