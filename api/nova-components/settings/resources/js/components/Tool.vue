<template>
    <loading-view :loading="loading">
        <heading class="mb-3">{{ __('Settings') }}</heading>

        <ul class="list-reset flex border-b2 ml-8">
            <li class="mr-1" v-for="(group,key,i) in groups" :key="'tab'+key">
                <a class="bg-white inline-block border-50 border-l border-t border-r rounded-t py-2 px-6 cursor-pointer"
                   @click.prevent="selectTab(i)" :class="i===selectedTab?'font-semibold text-primary':'border-b'">{{key}}</a>
            </li>
        </ul>
        <card class="overflow-hidden">
            <form v-if="fields" @submit.prevent="createResource" autocomplete="off">
                <!-- Validation Errors -->
                <validation-errors :errors="validationErrors"/>

                <div v-for="(section,key,index) in groups" :key="index" :class="index!==selectedTab?'hidden':''">
                    <!-- Fields -->
                    <div v-for="field in fields" v-if="key===field.section">
                        <component
                            :is="'form-' + field.component"
                            :errors="validationErrors"
                            :resource-name="resourceName"
                            :field="field"
                            :via-resource="viaResource"
                            :via-resource-id="viaResourceId"
                            :via-relationship="viaRelationship"
                        />
                    </div>
                </div>

                <!-- Create Button -->
                <div class="bg-30 flex px-8 py-4">
                    <progress-button
                        dusk="create-button"
                        type="submit"
                        :disabled="isWorking"
                        :processing="submittedViaCreateResource"
                    >
                        {{ __('Save') }} {{ singularName }}
                    </progress-button>
                </div>
            </form>
        </card>
    </loading-view>
</template>

<script>
    import {Errors, Minimum, InteractsWithResourceInformation} from 'laravel-nova'

    export default {
        mixins: [InteractsWithResourceInformation],

        props: {
            resourceName: {
                type: String,
                required: true,
                default: 'Settings'
            },
            viaResource: {
                default: '',
            },
            viaResourceId: {
                default: '',
            },
            viaRelationship: {
                default: '',
            },
        },

        data: () => ({
            loading: true,
            submittedViaCreateAndAddAnother: false,
            submittedViaCreateResource: false,
            fields: [],
            validationErrors: new Errors(),
            selectedTab: 0,
        }),

        async created() {
            this.resourceName = "settings";
            if (Nova.missingResource(this.resourceName)) return this.$router.push({name: '404'})

            // If this create is via a relation index, then let's grab the field
            // and use the label for that as the one we use for the title and buttons
            if (this.isRelation) {
                const {data} = await Nova.request(
                    '/nova-api/' + this.viaResource + '/field/' + this.viaRelationship
                )
                this.relationResponse = data
            }

            this.getFields()
        },

        methods: {
            selectTab(index) {
                this.selectedTab = index;
            },
            /**
             * Get the available fields for the resource.
             */
            async getFields() {
                this.fields = []

                const {data: {fields}} = await Nova.request().get(
                    `/nova-api/${this.resourceName}/creation-fields`,
                    {
                        params: {
                            editing: true,
                            editMode: 'create',
                            viaResource: this.viaResource,
                            viaResourceId: this.viaResourceId,
                            viaRelationship: this.viaRelationship,
                        },
                    }
                )

                this.fields = fields
                this.loading = false
            },

            /**
             * Create a new resource instance using the provided data.
             */
            async createResource() {
                this.submittedViaCreateResource = true

                try {
                    const response = await this.createRequest()
                    this.submittedViaCreateResource = false

                    this.$toasted.show(
                        this.__('The Settings was saved!', {
                            resource: this.resourceInformation.singularLabel.toLowerCase(),
                        }),
                        {type: 'success'}
                    )

                } catch (error) {
                    this.submittedViaCreateResource = false

                    if (error.response.status == 422) {
                        this.validationErrors = new Errors(error.response.data.errors)
                    }
                }
            },

            /**
             * Send a create request for this resource
             */
            createRequest() {
                return Nova.request().post(
                    `/nova-vendor/${this.resourceName}/${this.resourceName}`,
                    this.createResourceFormData()
                )
            },

            /**
             * Create the form data for creating the resource.
             */
            createResourceFormData() {
                return _.tap(new FormData(), formData => {
                    _.each(this.fields, field => {
                        field.fill(formData)
                    })
                })
            },
        },

        computed: {
            singularName() {
                if (this.relationResponse) {
                    return this.relationResponse.singularLabel
                }

                return this.resourceInformation.singularLabel
            },

            isRelation() {
                return Boolean(this.viaResourceId && this.viaRelationship)
            },

            /**
             * Determine if the form is being processed
             */
            isWorking() {
                return this.submittedViaCreateResource || this.submittedViaCreateAndAddAnother
            },
            groups() {
                return _.groupBy(this.fields, 'section')
            }
        },
    }
</script>
