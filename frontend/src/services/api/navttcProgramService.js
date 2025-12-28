import axiosInstance from './axiosInstance';

const API_ENDPOINT = '/api/navttc-programs';

export const navttcProgramService = {
  /**
   * Fetch all NAVTTC programs
   * @param {Object} params - Query parameters (page, limit, search, etc.)
   * @returns {Promise}
   */
  getAllPrograms: async (params = {}) => {
    try {
      const response = await axiosInstance.get(API_ENDPOINT, { params });
      return response.data;
    } catch (error) {
      console.error('Error fetching NAVTTC programs:', {
        message: error.message,
        status: error.response?.status,
        data: error.response?.data,
        url: error.config?.url,
      });
      throw error;
    }
  },

  /**
   * Fetch a single NAVTTC program by ID
   * @param {number} id - Program ID
   * @returns {Promise}
   */
  getProgramById: async (id) => {
    try {
      const response = await axiosInstance.get(`${API_ENDPOINT}/${id}`);
      return response.data;
    } catch (error) {
      console.error(`Error fetching NAVTTC program ${id}:`, error);
      throw error;
    }
  },

  /**
   * Create a new NAVTTC program (Admin only)
   * @param {Object} programData - Program data
   * @returns {Promise}
   */
  createProgram: async (programData) => {
    try {
      const response = await axiosInstance.post(API_ENDPOINT, programData);
      return response.data;
    } catch (error) {
      console.error('Error creating NAVTTC program:', error);
      throw error;
    }
  },

  /**
   * Update a NAVTTC program (Admin only)
   * @param {number} id - Program ID
   * @param {Object} programData - Updated program data
   * @returns {Promise}
   */
  updateProgram: async (id, programData) => {
    try {
      const response = await axiosInstance.put(`${API_ENDPOINT}/${id}`, programData);
      return response.data;
    } catch (error) {
      console.error(`Error updating NAVTTC program ${id}:`, error);
      throw error;
    }
  },

  /**
   * Delete a NAVTTC program (Admin only)
   * @param {number} id - Program ID
   * @returns {Promise}
   */
  deleteProgram: async (id) => {
    try {
      const response = await axiosInstance.delete(`${API_ENDPOINT}/${id}`);
      return response.data;
    } catch (error) {
      console.error(`Error deleting NAVTTC program ${id}:`, error);
      throw error;
    }
  },
};

export default navttcProgramService;
