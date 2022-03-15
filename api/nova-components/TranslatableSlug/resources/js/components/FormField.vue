<template>
    <field-wrapper>
        <div class="w-1/5 px-8 py-6">
            <slot>
                <form-label :for="field.name">
                    {{ field.name }}
                </form-label>
            </slot>
        </div>
        <div class="px-8 py-6" :class="computedWidth">
            <a
                class="inline-block font-bold cursor-pointer mr-2 animate-text-color select-none border-primary"
                :class="{ 'text-60': localeKey !== currentLocale, 'text-primary border-b-2': localeKey === currentLocale }"
                :key="`a-${localeKey}`"
                v-for="(locale, localeKey) in field.locales"
                @click="changeTab(localeKey)"
            >
                {{ locale }}
            </a>

            <input
                ref="field"
                type="text"
                :id="field.name"
                class="mt-4 w-full form-control form-input form-input-bordered"
                :class="errorClasses"
                :placeholder="field.name"
                v-model="value[currentLocale]"
                @keydown.tab="handleTab"
                :disabled="isReadonly"
                @keyup="handleKeydown"
                v-bind="extraAttributes"
                :dusk="field.attribute"
            />

            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>
            <help-text class="help-text mt-2" v-if="field.helpText">
                {{ field.helpText }}
            </help-text>
        </div>
    </field-wrapper>
</template>


<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [HandlesValidationErrors, FormField],
        data() {
            return {
                locales: Object.keys(this.field.locales),
                currentLocale: null,
            }
        },
        computed: {
            defaultAttributes() {
                return {
                    type: this.field.type || 'text',
                    min: this.field.min,
                    max: this.field.max,
                    step: this.field.step,
                    pattern: this.field.pattern,
                    placeholder: this.field.placeholder || this.field.name,
                    class: this.errorClasses,
                }
            },

            extraAttributes() {
                const attrs = this.field.extraAttributes

                return {
                    // Leave the default attributes even though we can now specify
                    // whatever attributes we like because the old number field still
                    // uses the old field attributes
                    ...this.defaultAttributes,
                    ...attrs,
                }
            },
            computedWidth() {
                return {
                    'w-1/2': true,
                }
            }
        },
        mounted() {
            this.currentLocale = this.locales[0] || null
        },
        methods: {
            handleKeydown(event) {
                if (this.currentLocale === this.field.slug_lang) {
                    Nova.$emit('field-update-' + this.field.slug, {
                        value: event.target.value
                    })
                }
            },

            setInitialValue() {
                this.value = this.field.value || {}
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                Object.keys(this.value).forEach(locale => {
                    formData.append(this.field.attribute + '[' + locale + ']', this.value[locale] || '')
                })
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value[this.currentLocale] = value
            },

            changeTab(locale) {
                this.currentLocale = locale;
                this.$nextTick(() => {
                    this.$refs.field.focus()
                })
            },

            handleTab(e) {
                const currentIndex = this.locales.indexOf(this.currentLocale);
                if (!e.shiftKey) {
                    if (currentIndex < this.locales.length - 1) {
                        e.preventDefault();
                        this.changeTab(this.locales[currentIndex + 1])
                    }
                } else {
                    if (currentIndex > 0) {
                        e.preventDefault();
                        this.changeTab(this.locales[currentIndex - 1])
                    }
                }
            }
        },
    }
</script>
