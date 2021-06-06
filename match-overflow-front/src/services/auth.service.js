import axios from "axios";

const API_URL = "http://localhost:8000/api/";

class AuthService {
  login(request) {
    return axios
      .post(API_URL + "login_check", request)
      .then((response) => {
        if (response.data.token) {
          localStorage.setItem("token", response.data.token);
        }

        return { success: true };
      })
      .catch(() => {
        return { success: false };
      });
  }

  logout() {
    localStorage.removeItem("token");
  }

  register(request) {
    return axios
      .post(API_URL + "signup", request)
      .then((response) => {
        if (!response) {
          return { success: false };
        }

        return this.login({
          username: request.email,
          password: request.password,
        });
      })
      .catch(() => {
        return { success: false };
      });
  }
}

export default new AuthService();
