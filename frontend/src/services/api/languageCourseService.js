import axiosInstance from './axiosInstance';

const API_ENDPOINT = '/api/language-courses';

const languageCourseService = {
    getAllCourses: async () => {
        try {
            const response = await axiosInstance.get(API_ENDPOINT);
            return response.data;
        } catch (error) {
            console.error('Error fetching language courses:', error);
            throw error;
        }
    },

    getCourseById: async (id) => {
        try {
            const response = await axiosInstance.get(`${API_ENDPOINT}/${id}`);
            return response.data;
        } catch (error) {
            console.error(`Error fetching language course ${id}:`, error);
            throw error;
        }
    },
};

export default languageCourseService;
