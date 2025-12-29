import "./UpcomingPrograms.css";
import { CalendarDays, MapPin, Search } from "lucide-react";
import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

const UpcomingPrograms = () => {
  const navigate = useNavigate();

  const months = [
    "JAN","FEB","MAR","APR","MAY","JUN",
    "JUL","AUG","SEP","OCT","NOV","DEC"
  ];

  // 🔹 STATE
  const [searchText, setSearchText] = useState("");
  const [allPrograms, setAllPrograms] = useState({});
  const [displayData, setDisplayData] = useState({});
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  // 🔹 FETCH UPCOMING PROGRAMS FROM API
  useEffect(() => {
    const fetchPrograms = async () => {
      try {
        setLoading(true);
        const response = await fetch("http://localhost:8000/api/upcoming-programs/by-month");
        
        if (!response.ok) {
          throw new Error("Failed to fetch programs");
        }

        const data = await response.json();
        console.log("API Response:", data); // Debug log
        
        if (data.data && typeof data.data === 'object' && Object.keys(data.data).length > 0) {
          console.log("Programs loaded successfully:", Object.keys(data.data)); // Debug
          setAllPrograms(data.data);
          setDisplayData(data.data);
        } else {
          console.warn("No programs data received:", data.data);
          setAllPrograms({});
          setDisplayData({});
        }
      } catch (err) {
        setError(err.message);
        console.error("Error fetching programs:", err);
      } finally {
        setLoading(false);
      }
    };

    fetchPrograms();
  }, []);

  // 🔹 DEBOUNCED SEARCH
  useEffect(() => {
    const timer = setTimeout(() => {
      if (!searchText.trim()) {
        // Show all programs when search is empty
        console.log("Clearing search, showing all programs:", allPrograms); // Debug
        setDisplayData(allPrograms);
        return;
      }

      console.log("Searching for:", searchText); // Debug
      // Filter programs based on search text
      const filtered = {};

      Object.keys(allPrograms).forEach((month) => {
        const monthPrograms = allPrograms[month];
        if (Array.isArray(monthPrograms)) {
          const programs = monthPrograms.filter((p) =>
            p.title.toLowerCase().includes(searchText.toLowerCase())
          );

          if (programs?.length) {
            filtered[month] = programs;
          }
        }
      });

      console.log("Filtered results:", filtered); // Debug
      setDisplayData(filtered);
    }, 300);

    return () => clearTimeout(timer);
  }, [searchText, allPrograms]);

  // 🔹 scroll handler
  const scrollToMonth = (month) => {
    const section = document.getElementById(month);
    if (section) {
      section.scrollIntoView({ behavior: "smooth", block: "start" });
    }
  };

  // 🔹 Determine which months to render
  const monthsToRender = searchText.trim()
    ? Object.keys(displayData)  // only months with search results
    : months;  // all months

  // 🔹 FORMAT DATE FROM DATABASE
  const formatDate = (program) => {
    if (!program.start_date && !program.end_date) return "";
    
    const startDate = new Date(program.start_date);
    const endDate = new Date(program.end_date);

    const startDay = startDate.toLocaleDateString("en-US", { day: "2-digit" });
    const endDay = endDate.toLocaleDateString("en-US", { day: "2-digit" });
    const month = endDate.toLocaleDateString("en-US", { month: "long" });
    const year = endDate.getFullYear();

    if (program.start_date && program.end_date) {
      return `${startDay} to ${endDay} ${month}, ${year}`;
    } else if (program.start_date) {
      return `${startDate.toLocaleDateString("en-US", {
        day: "2-digit",
        month: "long",
        year: "numeric"
      })}`;
    }
    return "";
  };

  if (loading) {
    return (
      <section className="up-programs container my-5">
        <div className="text-center py-5">
          <p>Loading upcoming programs...</p>
        </div>
      </section>
    );
  }

  return (
    <section className="up-programs container my-5">
      {error && (
        <div className="alert alert-danger mb-4">
          Error: {error}
        </div>
      )}

      {/* HEADER */}
      <div className="d-flex justify-content-between align-items-center mb-3">
        {/* <h2 className="up-title">Upcoming Programs</h2> */}

        <div className="d-flex gap-2">
          {/* <button className="btn btn-warning btn-sm">Download Calendar</button> */}
          {/* <button className="btn btn-warning btn-sm">Program Finder</button> */}
        </div>
      </div>

      {/* MONTH FILTER */}
      <div className="month-filter mb-4">
        {months.map((m) => (
          <span key={m} onClick={() => scrollToMonth(m)}>
            {m}
          </span>
        ))}
      </div>

      {/* SEARCH */}
      <div className="search-box mb-4">
        <h6>Search Our Open-Enrollment Programs</h6>
        <div className="d-flex">
          <div className="search-input flex-grow-1">
            <Search size={16} />
            <input
              type="text"
              placeholder="Search Program"
              value={searchText}
              onChange={(e) => setSearchText(e.target.value)}
            />
          </div>
          <button
            className="btn btn-warning btn-sm ms-2"
            onClick={() => setSearchText("")}
          >
            Clear Text
          </button>
        </div>
      </div>

      {/* MONTH SECTIONS */}
      {monthsToRender.map((month) => (
        <div key={month} id={month} className="mb-4">
          <div className="month-heading">{month}</div>

          <div className="program-list">
            {displayData[month]?.length ? (
              displayData[month].map((p, index) => (
                <div
                  key={p.id}
                  className={`program-row ${index % 2 !== 0 ? "alt" : ""}`}
                >
                  <div className="program-meta">
                    <CalendarDays size={14} />
                    <span>{formatDate(p)}</span>
                  </div>
                  <button
                    className="program-title-link"
                    onClick={() => navigate(`/program-detail/${p.id}`)}
                  >
                    {p.title}
                  </button>
                </div>
              ))
            ) : (
              !searchText && (
                <div className="no-program">
                  No programs available for this month.
                </div>
              )
            )}
          </div>
        </div>
      ))}
    </section>
  );
};

export default UpcomingPrograms;
