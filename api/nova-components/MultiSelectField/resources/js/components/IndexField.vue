<template>
    <div>
        <span v-for="segment in JSON.parse(field.value)" class="m-1 p-2 rounded-lg bg-primary-10%">{{ segment.label }}</span>
    </div>
</template>

<script>
export default {
    props: ['resourceName', 'field'],
}
</script>
