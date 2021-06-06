<template>
  <div class="matches">
    <h1>Matches</h1>

    <div class="ma-5">
      <v-row v-if="this.matches.length > 0">
        <v-col v-for="match in matches" :key="match.id" s="4" md="2">
          <v-card dark link>
            <v-img height="100px" :src="match.pictures[0]"> </v-img>
            <v-card-title class="text-subtitle" align-bottom>{{
              match.firstName
            }}</v-card-title>
          </v-card>
        </v-col>
      </v-row>
      <span v-else
        >&gt; You don't have matches yet... 😅 <br />
        &gt; Start liking people to have matches!</span
      >
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import matchService from "../services/match.service";

export default Vue.extend({
  name: "Matches",
  data() {
    return {
      matches: [],
    };
  },
  created() {
    if (!localStorage.getItem("token")) {
      this.$router.push("/login");
    }

    this.fetchMatches().then((response) => {
      this.matches = response.profiles;
    });
  },
  methods: {
    fetchMatches() {
      return matchService.getMatches();
    },
  },
});
</script>
