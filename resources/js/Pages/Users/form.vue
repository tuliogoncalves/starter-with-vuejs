<template>
    <head> </head>
    <crud
        contentHeader="User Manager"
        createTitle="Add new User"
        updateTitle="Update User"
        :urlUpdate="route('users.update', form.id ? form.id : 0)"
        :urlStore="route('users.store', form.id ? form.id : 0)"
        :urlDestroy="route('users.destroy', form.id ? form.id : 0)"
        :form="form"
    >
        <div class="col">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul
                        class="nav nav-tabs"
                        id="custom-tabs-four-tab"
                        role="tablist"
                    >
                        <li class="nav-item">
                            <a
                                class="nav-link active"
                                id="custom-tabs-four-home-tab"
                                data-toggle="pill"
                                href="#custom-tabs-four-home"
                                role="tab"
                                aria-controls="custom-tabs-four-home"
                                aria-selected="true"
                                >User</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                id="custom-tabs-four-profile-tab"
                                data-toggle="pill"
                                href="#custom-tabs-four-profile"
                                role="tab"
                                aria-controls="custom-tabs-four-profile"
                                aria-selected="false"
                                >Security</a
                            >
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div
                            class="tab-pane fade show active"
                            id="custom-tabs-four-home"
                            role="tabpanel"
                            aria-labelledby="custom-tabs-four-home-tab"
                        >
                            <!-- Name -->
                            <div class="form-group w-75">
                                <label for="user-name">Name</label>
                                <input
                                    id="user-name"
                                    type="text"
                                    class="form-control"
                                    :class="{ 'is-invalid': errors.name }"
                                    v-model="form.name"
                                />
                                <span class="invalid-feedback">{{
                                    errors.name
                                }}</span>
                            </div>

                            <!-- Email -->
                            <div class="form-group w-50">
                                <label for="user-email">Email</label>
                                <input
                                    id="user-email"
                                    type="text"
                                    class="form-control"
                                    :class="{ 'is-invalid': errors.email }"
                                    v-model="form.email"
                                />
                                <div class="invalid-feedback">
                                    {{ errors.email }}
                                </div>
                            </div>
                        </div>

                        <div
                            class="tab-pane fade"
                            id="custom-tabs-four-profile"
                            role="tabpanel"
                            aria-labelledby="custom-tabs-four-profile-tab"
                        >
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Roles</label>
                                            <select
                                                class="duallistbox"
                                                multiple="multiple"
                                            >
                                                <option
                                                    v-for="role in this.roles"
                                                    :value="role.id"
                                                >
                                                    {{ role.name }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </crud>
</template>

<script>
import { useForm } from "@inertiajs/inertia-vue3";
import Crud from "@/Scriptpage/Content/Crud.vue";

export default {
    components: {
        Crud,
    },

    props: {
        errors: Object,
        data: Object,
        roles: Object,
    },

    data() {
        var data = this.data;
        return {
            form: useForm({
                id: data.id,
                name: data.name,
                email: data.email,
                roles: [],
            }),
        };
    },

    mounted() {
        var form = this.form;
        var data = this.data;

        //Bootstrap Duallistbox
        //----------------------
        var duallist = $(".duallistbox");

        // Trigger
        duallist.on("change", function (e) {
            // form.duallist = duallist.val();
            form.roles = duallist.val();
        });

        var roles = null;

        // Filtre name roles
        if (data.roles) {
            var roles = data.roles.map(function (obj) {
                return obj.name;
            });
        }

        // Set value to duallist field
        duallist.val(roles);
        duallist.trigger("change");

        // Initialize
        duallist.bootstrapDualListbox({
            infoText: false,
        });
    },
};
</script>
