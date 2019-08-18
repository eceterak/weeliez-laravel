<template>
    <div class="search-select" v-on-clickaway="hideDropdown">
        <input type="text" 
            :class="classes"
            class="search-select-input"
            v-model="value"
            @focus="showDropdown">
        <div :class="dropdownClasses" class="search-select-dropdown">
            <ul>
                <li v-for="(option, index) in availableOptions" 
                    v-bind:key="option.id" 
                    v-text="option[optionLabel]"
                    @click="select(option, index)">
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    import {mixin as clickaway} from 'vue-clickaway';

    export default {
        props: ['data', 'label', 'classes'],
        mixins: [clickaway],
        data() {
            return {
                value: null, 
                displayDropdown: false,
                clearOnSelect: true,
                options: this.data
            }
        },
        mounted() {
            var string = 'Poland';
            var value = '';
        },
        computed: {
            dropdownClasses() {
                return this.displayDropdown ? 'd-block' : 'd-none';
            },
            optionLabel() {
                return this.label ? this.label : 'name';
            },
            availableOptions() {
                if(this.value) {
                    return this.options.filter(option => {
                        return option[this.optionLabel].toLowerCase().includes(this.value.toLowerCase());
                    });
                }
                else return this.options;
            }
        },
        methods: {
            showDropdown() {
                this.displayDropdown = true;
            },
            hideDropdown() {
                this.displayDropdown = false;
            },
            select(option, index) {
                this.$emit('select', option, index);

                if(this.clearOnSelect) this.value = null;

                this.hideDropdown();
            }
        }
    }
</script>


<style>

    .search-select {
        position: relative;
    }

    .search-select .search-select-dropdown {
        position: absolute;
        background: #FFF;
        z-index: 101;
        width: 100%;
    }

    .search-select .search-select-dropdown ul {
        display: -webkit-box;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        flex-direction: column;
        padding-left: 0;
        margin-bottom: 0;
    }

    .search-select .search-select-dropdown ul li {
        position: relative;
        display: block;
        padding: 0.75rem 1.25rem;
        margin-bottom: -1px;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.125);
    }

    .search-select .search-select-dropdown ul li:hover {
        background-color: #4d88bb;
        color: #FFF;
        cursor: pointer;
    }

</style>