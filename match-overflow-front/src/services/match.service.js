import axios from "axios";

const API_URL = "http://localhost:8000/api/";

class MatchService {
  getMatches() {
    return axios
      .get(API_URL + "match", {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      })
      .then((response) => {
        const profiles = response.data.map((match) => {
          if (match.pictures.length == 0) {
            match.pictures.push(
              "https://i.pinimg.com/originals/b7/f0/db/b7f0db1455d5a1fcfdb41ef6a13822e2.png"
            );
          }
          return match;
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

  sendLike(profileId) {
    return axios
      .post(
        API_URL + "like/" + profileId,
        {},
        {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        }
      )
      .then(() => {
        return { success: true };
      })
      .catch(() => {
        return { success: false };
      });
  }
}

export default new MatchService();
