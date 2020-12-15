import axios, { AxiosResponse } from "axios";
import api from "../utils/api";

class ArticleService {
    async fetchAllArticles(): Promise<AxiosResponse> {
        return axios.get(`${api.baseUrl}/readings`);
    }

    async markArticleAsRead(id: number): Promise<AxiosResponse> {
        return axios.post(`${api.baseUrl}/reading/update`, {
            reading_id: id
        });
    }

    async fetchNewArticles(): Promise<AxiosResponse> {
        return axios.get(`${api.baseUrl}/readings/new`);
    }
}

export default new ArticleService();