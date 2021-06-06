<template>
  <div class="register">
    <v-container class="my-5">
      <v-row justify="center">
        <v-col xs="12" md="6">
          <v-card class="pa-4" dark>
            <v-card-title class="text-h2">Register</v-card-title>
            <v-divider></v-divider>
            <form @submit.prevent="handleRegister" class="pa-4">
              <v-text-field
                v-model="request.email"
                label="Email"
                required
              ></v-text-field>

              <v-text-field
                v-model="request.password"
                label="Password"
                type="password"
                required
              ></v-text-field>

              <v-divider></v-divider>

              <v-text-field
                v-model="request.firstName"
                label="First name"
                required
              ></v-text-field>

              <v-slider
                v-model="request.age"
                class="align-center"
                max="100"
                min="18"
                hide-details
                label="Age"
              >
                <template v-slot:append>
                  <v-text-field
                    v-model="request.age"
                    class="mt-0 pt-0"
                    hide-details
                    single-line
                    type="number"
                    style="width: 60px"
                  ></v-text-field>
                </template>
              </v-slider>

              <v-row class="my-2">
                <v-col
                  ><v-radio-group v-model="request.sex">
                    <template v-slot:label>
                      <div>I'm a...</div>
                    </template>
                    <v-radio value="MALE">
                      <template v-slot:label>
                        <div>
                          Man
                        </div>
                      </template>
                    </v-radio>
                    <v-radio value="FEMALE">
                      <template v-slot:label>
                        <div>
                          Woman
                        </div>
                      </template>
                    </v-radio>
                    <v-radio value="OTHER">
                      <template v-slot:label>
                        <div>
                          Other
                        </div>
                      </template>
                    </v-radio>
                  </v-radio-group></v-col
                >
                <v-col
                  ><v-radio-group v-model="request.preference">
                    <template v-slot:label>
                      <div>looking for...</div>
                    </template>
                    <v-radio value="MALE">
                      <template v-slot:label>
                        <div>
                          Men
                        </div>
                      </template>
                    </v-radio>
                    <v-radio value="FEMALE">
                      <template v-slot:label>
                        <div>
                          Women
                        </div>
                      </template>
                    </v-radio>
                    <v-radio value="ALL">
                      <template v-slot:label>
                        <div>
                          I love everyone!
                        </div>
                      </template>
                    </v-radio>
                  </v-radio-group></v-col
                >
              </v-row>

              <v-col class="text-right"
                ><v-btn color="success" class="mr-4" type="submit">
                  Join();
                </v-btn></v-col
              >
            </form>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script lang="ts">
import Vue from "vue";
import authService from "../services/auth.service";

export default Vue.extend({
  name: "Register",
  data() {
    return {
      request: {
        email: "",
        password: "",
        firstName: "",
        age: 18,
        sex: "",
        preference: "",
        latitude: "",
        longitude: "",
      },
    };
  },
  created() {
    localStorage.removeItem("token");
    if (localStorage.getItem("token")) {
      this.$router.push("/");
    }

    navigator.geolocation.getCurrentPosition((position) => {
      this.request.latitude = position.coords.latitude;
      this.request.longitude = position.coords.longitude;
    });
  },
  methods: {
    handleRegister() {
      authService.register(this.request).then((response) => {
        if (response.success) {
          this.$router.push("/");
        }
      });
    },
  },
});
</script>
