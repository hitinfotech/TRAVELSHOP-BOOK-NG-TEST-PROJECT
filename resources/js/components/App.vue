<template>
    <div>
        <b-navbar toggleable="sm"  type="dark" variant="dark">
            <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>

            <b-navbar-brand>TRAVELSHOP BOOKİNG</b-navbar-brand>

            <b-collapse id="nav-text-collapse" is-nav>
                <b-navbar-nav>
                    <b-nav-text>TEST PROJECT</b-nav-text>
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>

        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="float-left m-0">Customers</h4>
                            <b-button class='float-right' @click="addCustomer()">Add Customer</b-button>
                        </div>

                        <div class="table-responsive-lg">
                            <table class="table table-striped">
                                <thead>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Address</th>
                                </thead>
                                <tbody>
                                    <tr v-for="cust in customers">
                                        <td @click="viewCustomer(cust)"><img :src="'/images/'+ cust.photo" height="50px" width="50px"></td>
                                        <td><a href="javascript:;" @click="editCustomer(cust)">{{ cust.name }}
                                        {{ cust.surname }}</a></td>
                                        <td @click="viewCustomer(cust)">{{ cust.email }}</td>
                                        <td @click="viewCustomer(cust)">{{ cust.phone }}</td>
                                        <td @click="viewCustomer(cust)">{{ cust.company }}</td>
                                        <td @click="viewCustomer(cust)">{{ cust.address.substring(0, 30) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <b-modal id="customerViewModal" title="Customer Info." hide-footer>
                                <table class="table table-striped">
                                    <tr>
                                        <td colspan="2"><img :src="'/images/'+ customer.photo" height="50px" width="50px"></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ customer.name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{ customer.email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ customer.phone }}</td>
                                    </tr>
                                    <tr>
                                        <th>Company</th>
                                        <td>{{ customer.company }}</td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td>{{ customer.address }}</td>
                                    </tr>
                                </table>
                            </b-modal>

                            <b-modal id="customerModal" title="Customer Detail" hide-footer>
                                <b-form @submit.stop.prevent="onSubmit">

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <b-form-group id="example-input-group-1" label="Name" label-for="example-input-1">
                                                <b-form-input
                                                id="example-input-1"
                                                name="example-input-1"
                                                v-model="$v.form.name.$model"
                                                :state="validateState('name')"
                                                aria-describedby="input-1-live-feedback"
                                                ></b-form-input>

                                                <b-form-invalid-feedback id="input-1-live-feedback"
                                                >This is a required field and must be at least 3 characters.</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                        <div class="col-sm-6">
                                            <b-form-group id="surname-input-group" label="surname" label-for="surname-input-group">
                                                <b-form-input
                                                id="surname-input-group"
                                                name="surname"
                                                v-model="$v.form.surname.$model"
                                                :state="validateState('surname')"
                                                aria-describedby="input-1-live-feedback"
                                                ></b-form-input>

                                                <b-form-invalid-feedback id="surname-feedback"
                                                >This is a required field and must be at least 3 characters.</b-form-invalid-feedback>
                                            </b-form-group>
                                        </div>
                                    </div>


                                    <b-form-group id="email-input-group" label="Email" label-for="email-input-group">
                                        <b-form-input
                                        id="email-input-group"
                                        name="email"
                                        v-model="$v.form.email.$model"
                                        :state="validateState('email')"
                                        aria-describedby="input-1-live-feedback"
                                        ></b-form-input>

                                        <b-form-invalid-feedback id="email-feedback"
                                        >Email is not valid.</b-form-invalid-feedback>
                                    </b-form-group>

                                    <b-form-group id="phone-input-group" label="Phone number" label-for="phone-input-group">
                                        <b-form-input
                                        id="phone-input-group"
                                        name="phone"
                                        v-mask="'(###) ###-####'"
                                        v-model="$v.form.phone.$model"
                                        :state="validateState('phone')"
                                        aria-describedby="input-1-live-feedback"
                                        ></b-form-input>

                                        <b-form-invalid-feedback id="phone-feedback"
                                        >Phone number is required.</b-form-invalid-feedback>
                                    </b-form-group>

                                    <b-form-group id="company-input-group" label="Company name" label-for="company-input-group">
                                        <b-form-input
                                        id="company-input-group"
                                        name="company"
                                        v-model="$v.form.company.$model"
                                        :state="validateState('company')"
                                        aria-describedby="input-1-live-feedback"
                                        ></b-form-input>

                                        <b-form-invalid-feedback id="company-feedback" 
                                        >Company name is required.</b-form-invalid-feedback>
                                    </b-form-group>

                                    <b-form-group id="address-input-group" label="Address" label-for="address-input-group">
                                        <b-form-textarea
                                        id="address-input-group"
                                        name="Address"
                                        v-model="$v.form.address.$model"
                                        :state="validateState('address')"
                                        aria-describedby="input-1-live-feedback"
                                        ></b-form-textarea>

                                        <b-form-invalid-feedback id="address-feedback" 
                                        >Address name is required.</b-form-invalid-feedback>
                                    </b-form-group>

                                    <b-form-group id="photo-lable-group" label="Profile Photo" label-for="photo-input-group">
                                        <b-form-file
                                        id="photo-input-group"
                                        name="photo"
                                        v-model="$v.form.photo.$model"
                                        :state="validateState('photo')"
                                        aria-describedby="input-1-live-feedback"
                                        ></b-form-file>

                                        <b-form-invalid-feedback id="photo-feedback" 
                                        >Photo is required.</b-form-invalid-feedback>
                                    </b-form-group>

                                    <div v-show='Object.keys(errors).length > 0' class="alert alert-danger">
                                        <b>The given data was invalid.</b>
                                        <ul >
                                            <li v-for="(error, key) in errors">{{key}}: {{error}}</li>
                                        </ul>
                                    </div>

                                    <b-button type="submit" variant="primary">Submit</b-button>
                                    <b-button class="ml-2" @click="resetForm()">Reset</b-button>
                                </b-form>
                            </b-modal>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>



<script>
    import { validationMixin } from "vuelidate";
    import { required, minLength, email } from "vuelidate/lib/validators";


    export default {
        mixins: [validationMixin],
        data() {
            return {
                customer: {},
                errors: [],
                customers: [],
                form: {
                    id: null,
                    name: null,
                    surname: null,
                    email: null,
                    phone: null,
                    address: null,
                    photo: null,
                    company: null
                }
            };
        },
        validations: {
            form: {
                email: {
                    required, email
                },
                phone: {
                    required
                },
                address: {
                    required
                },
                photo: {
                    required
                },
                company: {
                    required
                },
                name: {
                    required,
                    minLength: minLength(3)
                },
                surname: {
                    required,
                    minLength: minLength(3)
                }
            }
        },
        created() {
            this.loadCustomer();
        },
        methods: {
            validateState(name) {
                const { $dirty, $error } = this.$v.form[name];
                return $dirty ? !$error : null;
            },

            addCustomer() {
                this.resetForm();
                this.$bvModal.show('customerModal')
            },
            resetForm() {
                this.errors = {}

                this.form = {
                    id: null,
                    name: null,
                    surname: null,
                    phone: null,
                    email: null,
                    company: null,
                    photo: null,
                    address: null
                };

                this.$nextTick(() => {
                    this.$v.$reset();
                });
            },
            viewCustomer(customer) {
                this.$bvModal.show('customerViewModal')

                this.customer = customer
            },

            editCustomer(customer) {
                this.resetForm();
                this.$bvModal.show('customerModal')

                this.form = {
                    id: customer.id,
                    name: customer.name,
                    surname: customer.surname,
                    phone: customer.phone,
                    email: customer.email,
                    company: customer.company,
                    photo: null,
                    address: customer.address
                };
            },

            loadCustomer() {
                axios.get('/api/customer')
                .then(response => {
                    this.customers = response.data;
                });
            },
            onSubmit() {
                this.$v.form.$touch();
                var self = this;

                if (this.$v.form.$anyError) {
                    return;
                }

                const formData = new FormData()
                formData.append('id', this.form.id)
                formData.append('name', this.form.name)
                formData.append('surname', this.form.surname)
                formData.append('phone', this.form.phone)
                formData.append('email', this.form.email)
                formData.append('company', this.form.company)
                formData.append('photo', this.form.photo)
                formData.append('address', this.form.address)

                axios.post('/api/customer/submit', formData,{
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    if(response.data.success){
                        this.$bvModal.hide('customerModal')
                        this.loadCustomer();
                    }
                }).catch(function(error){
                    console.log(error.response.data)
                    self.errors = error.response.data.errors
                })
            }
        }
    };
</script>