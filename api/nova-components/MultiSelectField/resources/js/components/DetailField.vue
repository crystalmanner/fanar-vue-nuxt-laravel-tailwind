<template>
    <div class="flex border-b border-40">
        <div class="w-1/4 py-4">
            <h4 class="font-normal text-80">{{ field.name }}</h4>
        </div>
        <div class="w-3/4 py-4">
            <span v-for="segment in value" class="m-1 p-2 rounded-lg bg-primary-10%">{{ segment.label }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],
        computed: {
            value: {
                get: function () {
                    const value = this.field.value || [];
                    const options = this.field.options || [];
                    return options.filter(item => {
                        return value.find(item2 => {
                            return item.value === item2;
                        });
                    });
                },
            }
        },
    }
</script>
