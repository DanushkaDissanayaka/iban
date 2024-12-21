<template>
    <div class="form-group">
        <label :for="identifier" class="form-label">{{ title }}
            <span class="requireField" v-if="validation">*</span>
        </label>
        <div class="position-relative">
            <input :type="type" class="form-control" :required="validation" :id="identifier" :class="extraClasses" :placeholder="title" v-model="localValue" autocomplete="off" :disabled="disabled"/>
            <font-awesome-icon icon="eye" class="password-view" @mousedown="showPassword" @mouseup="hidePassword" />
            <div class="invalid-feedback" v-if="validationMessage">{{ validationMessage }}</div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: {
            type: String,
            required: true,
        },
        validation: {
            type: Boolean,
            required: false,
            default: false,
        },
        validationMessage: {
            type: String,
            required: false,
            default: '',
        },
        modelValue: {
            required: false,
            default: '',
        },
        extraClass: {
            required: false,
            default: '',
        },
        disabled: {
            type: Boolean,
            required: false,
            default: false,
        },
    },
    emits: [
        'update:modelValue'
    ],
    data() {
        return {
            inputValue: this.modelValue,
            type: 'password',
        }
    },
    methods: {
        showPassword: function () {
            this.type = 'text';
        },
        hidePassword: function () {
            this.type = 'password';
        }
    },
    computed: {
        identifier: function () {
            return this.title.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
        },
        validationMessageClass() {
            if (this.validationMessage) {
                return 'is-invalid';
            }
            return false;
        },
        localValue: {
            get() {
                return this.modelValue;
            },
            set(value) {
                this.$emit('update:modelValue', value);
            },
        },
        extraClasses: function () {
            return this.validationMessageClass + ' ' + this.extraClass;
        }
    },
}
</script>
<style scoped>
svg.password-view {
    position: absolute;
    top: 8px;
    right: 10px;
}
</style>