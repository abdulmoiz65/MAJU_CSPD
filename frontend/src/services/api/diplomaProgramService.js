import axiosInstance from './axiosInstance';

const API_ENDPOINT = '/api/diploma-programs';

const diplomaProgramService = {
    getAllPrograms: async () => {
        try {
            const response = await axiosInstance.get(API_ENDPOINT);
            return response.data;
        } catch (error) {
            console.error('Error fetching diploma programs:', error);
            throw error;
        }
    },

    getProgramById: async (id) => {
        try {
            const response = await axiosInstance.get(`${API_ENDPOINT}/${id}`);
            return response.data;
        } catch (error) {
            console.error(`Error fetching diploma program ${id}:`, error);
            throw error;
        }
    },
};

export default diplomaProgramService;
