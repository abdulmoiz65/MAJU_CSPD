import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import Heading from "../components/Heading";
import languageCourseService from "../services/api/languageCourseService";

const LanguageCourses = () => {
  const [courses, setCourses] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const fetchCourses = async () => {
      try {
        const response = await languageCourseService.getAllCourses();
        if (response.success) {
          setCourses(response.data);
        }
      } catch (error) {
        console.error("Error fetching language courses:", error);
      } finally {
        setLoading(false);
      }
    };
    fetchCourses();
  }, []);

  return (
    <>
      <Heading title="Language Courses" />
      <div className="container my-5">
        {loading ? (
          <div className="text-center py-5">
            <p>Loading courses...</p>
          </div>
        ) : courses.length === 0 ? (
          <div className="text-center py-5">
            <p>No language courses available at the moment.</p>
          </div>
        ) : (
          <ul className="list-group list-group-flush">
            {courses.map((course) => (
              <li key={course.id} className="list-group-item py-3 d-flex align-items-center gap-3">
                <span style={{ width: 10, height: 10, borderRadius: '50%', backgroundColor: '#112269', flexShrink: 0 }}></span>
                <Link
                  to={`/language-course-detail/${course.id}`}
                  className="text-decoration-none fw-semibold fs-5"
                >
                  {course.title}
                </Link>
              </li>
            ))}
          </ul>
        )}
      </div>
    </>
  );
};

export default LanguageCourses;
