import axiosInstance from './axiosInstance';

const API_ENDPOINT = '/api/calendar/active';

export const calendarService = {
    /**
     * Fetch the active calendar
     * @returns {Promise}
     */
    getActiveCalendar: async () => {
        try {
            const response = await axiosInstance.get(API_ENDPOINT);
            return response.data;
        } catch (error) {
            console.error('Error fetching active calendar:', {
                message: error.message,
                status: error.response?.status,
                data: error.response?.data,
            });
            throw error;
        }
    },
};

export default calendarService;
