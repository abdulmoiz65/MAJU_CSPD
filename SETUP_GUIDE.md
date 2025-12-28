# NAVTTC Programs API Setup Guide

## Problem
React frontend (port 5173) cannot fetch data from Laravel backend (port 8000).

## Solution Steps

### Backend Setup

1. **Seed the database with test programs:**
   ```bash
   cd backend
   php artisan db:seed --class=NavttcProgramSeeder
   ```

2. **Start the Laravel development server:**
   ```bash
   php artisan serve --host=0.0.0.0 --port=8000
   ```

3. **Test the API endpoint:**
   ```bash
   curl -X GET "http://localhost:8000/api/navttc-programs" \
     -H "Accept: application/json"
   ```

### Frontend Setup

1. **Ensure .env.local exists with correct API URL:**
   ```
   VITE_API_BASE_URL=http://localhost:8000
   ```

2. **Start the React development server:**
   ```bash
   cd frontend
   npm run dev
   ```

3. **Visit the NAVTTC Programs page:**
   - Open http://localhost:5173 in your browser
   - Navigate to the NAVTTC Programs section
   - Check browser console for any errors (F12 → Console tab)

### Troubleshooting

**If you see "Failed to load programs":**

1. **Check Laravel server is running:**
   - Visit http://localhost:8000 in browser
   - Should see Laravel welcome page or routing error

2. **Check CORS headers:**
   - The backend now includes CORS middleware
   - Should allow requests from localhost:5173

3. **Check browser console:**
   - Open DevTools (F12)
   - Go to Console tab
   - Look for error messages with status codes
   - Check Network tab to see the actual API request

4. **Verify database connection:**
   ```bash
   php artisan tinker
   >>> App\Models\NavttcProgram::where('status','active')->count()
   ```

### Files Modified

**Backend:**
- `routes/api.php` - API routes (no double /api prefix)
- `bootstrap/app.php` - Added CORS middleware
- `config/cors.php` - CORS configuration
- `app/Http/Controllers/Api/NavttcProgramController.php` - Public API controller
- `database/seeders/NavttcProgramSeeder.php` - Test data seeder

**Frontend:**
- `src/services/api/axiosInstance.js` - Axios configuration with interceptors
- `src/services/api/navttcProgramService.js` - API service with detailed error logging
- `src/components/NavttcPrograms.jsx` - Component updated to fetch from API
- `.env.local` - API base URL configuration

## Expected Response

When the API works correctly, you should see a JSON response:

```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "title": "Amazon Virtual Assistant",
      "required_qualification": "Intermediate",
      "apply_link": "https://nsis.navttc.gov.pk/",
      "status": "active",
      "created_at": "2025-12-29...",
      "updated_at": "2025-12-29..."
    },
    ...
  ],
  "message": "Programs retrieved successfully"
}
```
