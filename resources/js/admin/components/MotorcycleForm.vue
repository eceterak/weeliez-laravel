<template>
    <b-form :action="endpoint" method="POST">
        <b-card no-body>
            <b-tabs card>
                <b-tab title="General" active>
                    <b-card-text>
                        <input type="hidden" name="_token" :value="csrf">
                        <input type="hidden" name="_method" :value="method">
                        <b-form-group label="Name" label-for="name">
                            <b-form-input v-model="form.name" type="text" id="name" name="name"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Year start" label-for="year_start">
                            <b-form-input v-model="form.year_start" type="text" id="year_start" name="year_start"></b-form-input>
                        </b-form-group>
                        <b-form-group label="Brand" label-for="brand">
                            <multiselect 
                                v-model="brands.value" 
                                track-by="id"
                                label="name"
                                placeholder=""
                                :clearOnSelect="false"
                                :options="brands.options">
                            </multiselect>
                            <input type="hidden" id="brand" name="brand_id" v-model="brands.value.id">
                        </b-form-group>
                        <b-form-group label="Category" label-for="category">
                            <multiselect 
                                v-model="categories.value" 
                                track-by="id"
                                label="name"
                                placeholder=""
                                :options="categories.options">
                            </multiselect>
                            <input type="hidden" id="category" name="category_id" v-model="categories.value.id">
                        </b-form-group>
                    </b-card-text>
                </b-tab>
                <b-tab title="Specs">
                    <b-card-text>
                        <specsform
                            :specifications="specifications"
                            :data="data">
                        </specsform>
                    </b-card-text>
                </b-tab>
                <b-tab title="Images">
                    <b-card-text>Images</b-card-text>
                </b-tab>
            </b-tabs>
        </b-card>
        <b-navbar fixed="bottom" type="light" variant="light" class="bg-white shadow offset-2">
            <b-button type="submit">Submit</b-button>
        </b-navbar>
    </b-form>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import specsform from './SpecsForm';

    export default {
        components: {Multiselect, specsform},

        props: ['motorcycle', 'specifications', 'data'],

        data() {
            return {
                form: {
                    name: this.motorcycle ? this.motorcycle.name : '',
                    year_start: this.motorcycle ? this.motorcycle.year_start : ''
                },

                brands: {
                    value: {},
                    options: []
                },
                
                categories: {
                    value: {},
                    options: []
                }
            }
        },

        computed: {
            endpoint() {
                return this.motorcycle ? '/' + this.$adminPath + '/motorcycles/' + this.motorcycle.slug : '/' + this.$adminPath + '/motorcycles';
            },
            csrf() {
                return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            },
            method() {
                return this.motorcycle ? 'PATCH' : 'POST';
            }
        },

        methods: {
            persist(e) {
                e.preventDefault();

                var form = e.target;
                var data = new FormData(form);

                
                data.append('_method', 'PATCH');
                
                //console.log(data.values());

                var dt = JSON.stringify(this.form);

                console.log(dt);

                this.form._method = 'PATCH';

                axios.post(this.endpoint, this.form);


                

                
            }
        },

        created() {
            axios.get('/' + this.$adminPath + '/brands')
                .then(response => {
                    this.brands.options = response.data
                });

            axios.get('/' + this.$adminPath + '/categories')
                .then(response => {
                    this.categories.options = response.data
                });

            if(this.motorcycle) {
                this.brands.value = this.motorcycle.brand;

                this.categories.value = this.motorcycle.category;
            }
        }
    }
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<style>

</style>

