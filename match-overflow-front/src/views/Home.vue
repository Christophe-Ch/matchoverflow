<template>
  <div class="home">
    <v-container class="my-5">
      <v-row justify="center">
        <v-col xs="12" md="6">
          <v-card dark v-if="recs.length > 0">
            <v-carousel height="30vh" hide-delimiters>
              <v-carousel-item
                v-for="picture in this.recs[0].pictures"
                :key="picture"
                :src="picture"
              >
              </v-carousel-item>
            </v-carousel>

            <v-card-title>
              <v-flex>
                <span class="text-h2 mx-2 mt-2">{{
                  this.recs[0].firstName
                }}</span>
                <span class="text-h4 grey--text mx-2 mt-2">{{
                  this.recs[0].age
                }}</span>
              </v-flex>
            </v-card-title>

            <v-divider></v-divider>

            <div class="pb-4 px-4">
              <template v-if="this.recs[0].hobbies.length > 0">
                <v-chip
                  class="mx-2 mt-4"
                  v-for="hobby in this.recs[0].hobbies"
                  :key="hobby"
                >
                  {{ hobby }}
                </v-chip>
              </template>
              <div v-else class="mx-2 mt-4">
                <span class="grey--text font-italic"
                  >[404] Hobbies not found...</span
                >
              </div>
            </div>

            <v-divider></v-divider>

            <div class="pa-6">
              <span v-if="this.recs[0].description != null">{{
                this.recs[0].description
              }}</span>
              <span v-else class="grey--text font-italic"
                >[404] Description not found...</span
              >
            </div>

            <v-divider></v-divider>

            <div class="pa-6 d-flex justify-space-between">
              <v-btn color="error" @click="dislike">dislike();</v-btn>
              <v-btn color="success" @click="like">like();</v-btn>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Vue from "vue";
import recommendationService from "../services/recommendation.service";

export default Vue.extend({
  name: "Home",
  data() {
    return {
      recs: [],
    };
  },
  created() {
    if (!localStorage.getItem("token")) {
      this.$router.push("/login");
    }

    this.fetchRecommendations().then((response) => {
      this.recs = response.profiles;
    });
  },
  methods: {
    fetchRecommendations() {
      return recommendationService.fetchRecommendations();
    },
    dislike() {
      this.recs.shift();
    },
    like() {
      recommendationService.sendLike(this.recs[0].id);
      this.recs.shift();
    },
  },
});
</script>
