<template>
    <div>
        <div v-for="(attributes, type) in options" v-bind:key="type" class="mb-4">
            <h6 class="font-weight-bold">{{ type }}</h6>
            <b-list-group v-if="specifications.hasOwnProperty(type)">
                <b-list-group-item v-for="(spec, index) in specifications[type]" v-bind:key="spec.id" class="border-0 px-0">
                    <b-form-row>
                        <b-col cols="3" align-self="center">
                            <label class="m-0">{{ spec.attribute.name }}</label>
                        </b-col>
                        <b-col cols="3">
                            <b-form-input type="text" :name="'spec[' + spec.type.id + '][' + spec.attribute.id + ']'" :value="spec.value"></b-form-input>
                        </b-col>
                        <b-col cols="3" align-self="center">
                            <i class="fas fa-times" @click="removeSpec(spec, index)"></i>
                        </b-col>
                    </b-form-row>
                </b-list-group-item>
                <b-list-group-item class="border-0 px-0">
                    <b-form-row>
                        <b-col cols="3" align-self="center">Add spec</b-col>
                        <b-col cols="3">
                            <searchselect
                                label="name"
                                classes="form-control"
                                :data="attributes"
                                @select="optionSelected">
                            </searchselect>
                        </b-col>
                    </b-form-row>
                </b-list-group-item>
            </b-list-group>
        </div>
    </div>
</template>

<script>
    import searchselect from './SearchSelect';

    export default {
        components: { searchselect },

        props: ['specifications', 'data'],

        data() {
            return {
                specs: this.specifications,
                options: this.data
            }
        },
        methods: {
            optionSelected(option, index) {
                let type = option.type.name;

                this.options[type].splice(index, 1);

                this.specs[type].push({
                    attribute: {
                        id: option.id,
                        name: option.name,
                    },
                    type: {
                        id: option.type.id,
                        name: option.type.name
                    },
                    value: null
                });
            },
            removeSpec(spec, index) {
                let type = spec.type.name;

                this.specs[type].splice(index, 1);

                this.options[type].push({
                    id: spec.attribute.id,
                    name: spec.attribute.name,
                    type: spec.type,
                });
            },
        }
    }
</script>


<style>

</style>

