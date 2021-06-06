<template>
  <nav>
    <v-toolbar flat app dark>
      <v-app-bar-nav-icon
        v-if="isAuthenticated"
        class="grey--text"
        @click="drawer = !drawer"
      ></v-app-bar-nav-icon>
      <v-toolbar-title class="text-uppercase grey--text">
        <span class="font-weight-light">Match</span>
        <span>Overflow</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn text color="grey" v-if="isAuthenticated" @click="signOut">
        <span>Sign Out</span>
        <v-icon right>mdi-exit-to-app</v-icon>
      </v-btn>
    </v-toolbar>

    <v-navigation-drawer
      v-model="drawer"
      app
      temporary
      dark
      v-if="isAuthenticated"
    >
      <template v-slot:prepend>
        <v-list-item two-line>
          <v-list-item-avatar>
            <img src="https://randomuser.me/api/portraits/women/81.jpg" />
          </v-list-item-avatar>

          <v-list-item-content>
            <v-list-item-title>Jane Smith</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </template>

      <v-divider></v-divider>

      <v-list>
        <v-list-item
          v-for="link in links"
          :key="link.text"
          router
          :to="link.route"
        >
          <v-list-item-icon>
            <v-icon>{{ link.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>{{ link.text }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
  </nav>
</template>

<script>
import authService from "../services/auth.service";
export default {
  name: "NavBar",
  data() {
    return {
      drawer: false,
      links: [
        { icon: "mdi-home", text: "Home", route: "/" },
        { icon: "mdi-heart", text: "Matches", route: "/matches" },
        { icon: "mdi-account-settings", text: "Settings", route: "/settings" },
      ],
    };
  },
  computed: {
    isAuthenticated() {
      return this.$route.name !== "Login" && this.$route.name !== "Register";
    },
  },
  methods: {
    signOut() {
      authService.logout();
      this.$router.push("/login");
    },
  },
};
</script>

<style></style>
