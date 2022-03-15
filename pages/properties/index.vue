<template>

</template>

<script>
    export default {
      created() {
        this.$router.push({
          path: `${this.$i18n.locale === 'ar' ? '' : '/' + this.$i18n.locale}/properties/istanbul`,
        });
      }
    }
</script>
