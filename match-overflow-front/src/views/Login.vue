<template>
  <div class="login">
    <v-container class="my-5">
      <v-row justify="center">
        <v-col xs="12" md="6">
          <v-card class="pa-4" dark>
            <v-card-title class="text-h2">Login</v-card-title>
            <v-divider></v-divider>
            <form @submit.prevent="handleLogin" class="pa-4">
              <v-text-field
                v-model="request.username"
                label="Email"
                required
              ></v-text-field>
              <v-text-field
                v-model="request.password"
                label="Password"
                type="password"
                required
              ></v-text-field>
              <v-col class="text-right"
                ><v-btn color="success" class="mr-4" type="submit">
                  Login();
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
  name: "Login",
  data() {
    return {
      request: {
        username: "",
        password: "",
      },
    };
  },
  created() {
    if (localStorage.getItem("token")) {
      this.$router.push("/");
    }
  },
  methods: {
    handleLogin() {
      authService.login(this.request).then((response) => {
        if (response.success) {
          this.$router.push("/");
        }
      });
    },
  },
});
</script>
