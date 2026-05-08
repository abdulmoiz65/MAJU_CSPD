import axiosInstance from './axiosInstance';

const API_ENDPOINT = '/api/summer-schools';

const summerSchoolService = {
    getAllSchools: async () => {
        try {
            const response = await axiosInstance.get(API_ENDPOINT);
            return response.data;
        } catch (error) {
            console.error('Error fetching summer schools:', error);
            throw error;
        }
    },

    getSchoolById: async (id) => {
        try {
            const response = await axiosInstance.get(`${API_ENDPOINT}/${id}`);
            return response.data;
        } catch (error) {
            console.error(`Error fetching summer school ${id}:`, error);
            throw error;
        }
    },
};

export default summerSchoolService;
