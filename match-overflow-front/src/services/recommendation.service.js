import axios from "axios";

const API_URL = "http://localhost:8000/api/rec";

class RecommendationService {
  fetchRecommendations() {
    const config = {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };

    return axios
      .get(API_URL, config)
      .then((response) => {
        const profiles = response.data.map((rec) => {
          if (rec.pictures.length == 0) {
            rec.pictures.push(
              "https://i.pinimg.com/originals/b7/f0/db/b7f0db1455d5a1fcfdb41ef6a13822e2.png"
            );
          }
          return rec;
        });
        return {
          success: true,
          profiles,
        };
      })
      .catch(() => {
        return { success: false };
      });
  }
}

export default new RecommendationService();
