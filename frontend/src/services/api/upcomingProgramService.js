// FOR 6 UP_CARDS 

import axiosInstance from './axiosInstance';

const API_ENDPOINT = '/api/upcoming-programs';

export const upcomingProgramService = {
    /**
     * Fetch all upcoming programs
     * @param {Object} params - Query parameters
     * @returns {Promise}
     */
    getAllPrograms: async (params = {}) => {
        try {
            const response = await axiosInstance.get(API_ENDPOINT, { params });
            return response.data;
        } catch (error) {
            console.error('Error fetching upcoming programs:', {
                message: error.message,
                status: error.response?.status,
                data: error.response?.data,
            });
            throw error;
        }
    },

    /**
     * Fetch latest N upcoming programs
     * @param {number} limit - Number of programs to fetch
     * @returns {Promise}
     */
    getLatestPrograms: async (limit = 6) => {
        try {
            const response = await axiosInstance.get(API_ENDPOINT);
            if (response.data.success && response.data.data) {
                // Return only the first N programs
                return {
                    ...response.data,
                    data: response.data.data.slice(0, limit)
                };
            }
            return response.data;
        } catch (error) {
            console.error('Error fetching latest programs:', error);
            throw error;
        }
    },

    /**
     * Fetch a single program by ID
     * @param {number} id - Program ID
     * @returns {Promise}
     */
    getProgramById: async (id) => {
        try {
            const response = await axiosInstance.get(`${API_ENDPOINT}/${id}`);
            return response.data;
        } catch (error) {
            console.error(`Error fetching program ${id}:`, error);
            throw error;
        }
    },

    /**
     * Fetch programs grouped by month
     * @returns {Promise}
     */
    getProgramsByMonth: async () => {
        try {
            const response = await axiosInstance.get(`${API_ENDPOINT}/by-month`);
            return response.data;
        } catch (error) {
            console.error('Error fetching programs by month:', error);
            throw error;
        }
    },
};

export default upcomingProgramService;
