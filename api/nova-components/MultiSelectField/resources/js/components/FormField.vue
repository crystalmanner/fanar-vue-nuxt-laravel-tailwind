<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <multiselect
                :id="field.name"
                :class="errorClasses"
                v-model="value"
                :options="options"
                :multiple="true"
                track-by="value"
                label="label"
                openDirection="top"
                :loading="loading"
                :taggable="tagging" @tag="addTag"
            ></multiselect>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'
    import Multiselect from 'vue-multiselect'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        components: {Multiselect},

        props: ['resourceName', 'resourceId', 'field'],
        data() {
            return {
                options: [],
                loading: true,
                parentValue: null
            }
        },

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                if (this.field.options) {
                    this.options = this.field.options;
                }

                this.setValue();
            },

            setValue() {
                const value = this.field.value || [];
                this.value = this.options.filter(item => {
                    return value.find(item2 => {
                        return item.value === item2;
                    });
                });
                this.loading = false;
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                this.value.forEach(item => {
                    formData.append(this.field.attribute + '[]', item['value']);
                });
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            },

            updateOptions() {
                this.options = [];
                this.loading = true;

                if (this.notWatching() || (this.parentValue != null && this.parentValue != '')) {
                    Nova.request().get(this.endpoint)
                        .then(response => {
                            this.options = response.data;
                            this.setValue();
                        })
                }
            },

            notWatching() {
                return this.field.parent_attribute == undefined;
            },

            isWatchingComponent(component) {
                return component.field !== undefined
                    && component.field.attribute == this.field.parent_attribute;
            },

            addTag(newTag) {
                const tag = {
                    label: newTag,
                    value: newTag
                };
                this.options.push(tag);
                this.value.push(tag);
            }
        },

        mounted() {
            this.watchedComponents.forEach(component => {

                let attribute = 'value';

                if (component.field.component === 'belongs-to-field') {
                    attribute = 'selectedResource';
                }

                component.$watch(attribute, (value) => {

                    this.parentValue = (value && attribute == 'selectedResource') ? value.value : value;

                    this.updateOptions();
                }, {immediate: true});
            });
        },

        computed: {
            watchedComponents() {
                return this.$parent.$children.filter(component => {
                    return this.isWatchingComponent(component);
                })
            },
            tagging() {
                return this.field.tagging;
            },
            endpoint() {
                return this.field.endpoint
                    .replace('{resource-name}', this.resourceName)
                    .replace('{resource-id}', this.resourceId ? this.resourceId : '')
                    .replace('{' + this.field.parent_attribute + '}', this.parentValue ? this.parentValue : '')
            },
            empty() {
                return !this.loading && this.options.length == 0;
            },

            disabled() {
                return this.loading == false && (this.field.parent_attribute != undefined && this.parentValue == null) || this.options.length == 0;
            }
        },
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
