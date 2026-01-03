import React, { useEffect, useState } from 'react';
import '../components/NavttcProgram.css';
import Heading from '../components/Heading';
import { Search, Loader } from "lucide-react";

const CompletedPrograms = () => {
    const [programs, setPrograms] = useState([]);
    const [filteredPrograms, setFilteredPrograms] = useState([]);
    const [searchText, setSearchText] = useState("");
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchPrograms = async () => {
            try {
                const response = await fetch("http://localhost:8000/api/upcoming-programs/completed");
                if (!response.ok) {
                    throw new Error("Failed to fetch programs");
                }
                const result = await response.json();
                setPrograms(result.data || []);
                setFilteredPrograms(result.data || []);
            } catch (err) {
                setError(err.message);
            } finally {
                setLoading(false);
            }
        };

        fetchPrograms();
    }, []);

    // Debounce search
    useEffect(() => {
        const timer = setTimeout(() => {
            const query = searchText.toLowerCase().trim();

            if (!query) {
                setFilteredPrograms(programs);
                return;
            }

            const filtered = programs.filter(
                (program) =>
                    program.title.toLowerCase().includes(query) ||
                    (program.overview && program.overview.toLowerCase().includes(query))
            );

            setFilteredPrograms(filtered);
        }, 300);

        return () => clearTimeout(timer);
    }, [searchText, programs]);

    const formatDate = (program) => {
        if (!program.start_date && !program.end_date) return "TBA";
        if (program.formatted_date) return program.formatted_date;
        const startDate = new Date(program.start_date);
        return startDate.toLocaleDateString("en-US", {
            day: "2-digit",
            month: "short",
            year: "numeric"
        });
    };



    return (
        <>
            <Heading
                title="Past Programs"
                description="Explore our successfully completed professional development programs."
            />

            <section className="trades-section container my-5">
                {/* SEARCH BAR */}
                <div className="trades-search mb-3">
                    <Search size={16} />
                    <input
                        type="text"
                        placeholder="Search program..."
                        value={searchText}
                        onChange={(e) => setSearchText(e.target.value)}
                        disabled={loading}
                    />
                </div>

                {error && (
                    <div className="alert alert-danger mb-4">
                        Error: {error}
                    </div>
                )}

                {loading && (
                    <div className="text-center py-5">
                        <Loader size={32} className="spinner-border" />
                        <p className="mt-3">Loading programs...</p>
                    </div>
                )}

                {!loading && (
                    <div className="table-responsive">
                        <table className="table trades-table">
                            <thead>
                                <tr>
                                    <th style={{ width: '5%' }}>S.#</th>
                                    <th style={{ width: '25%' }}>Program Title</th>
                                    <th style={{ width: '35%' }}>Overview</th>
                                    <th style={{ width: '15%' }}>Date</th>
                                    <th style={{ width: '20%' }}>Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                {filteredPrograms.length ? (
                                    filteredPrograms.map((program, index) => (
                                        <tr key={program.id}>
                                            <td>{index + 1}</td>
                                            <td className="fw-bold">{program.title}</td>
                                            <td>
                                                <div style={{
                                                    display: '-webkit-box',
                                                    WebkitLineClamp: '2',
                                                    WebkitBoxOrient: 'vertical',
                                                    overflow: 'hidden',
                                                    fontSize: '0.9rem',
                                                    color: '#6c757d'
                                                }}>
                                                    {program.overview || 'No overview available.'}
                                                </div>
                                            </td>
                                            <td>{formatDate(program)}</td>
                                            <td>
                                                <div className="d-flex flex-column gap-1">
                                                    {program.duration && (
                                                        <div className="d-flex align-items-center">
                                                            <i className="lucide-clock me-2" style={{ width: '14px', height: '14px' }}></i>
                                                            <span className="text-muted small me-1">Duration:</span>
                                                            <span className="fw-medium small">{program.duration}</span>
                                                        </div>
                                                    )}
                                                    {program.total_hours && (
                                                        <div className="d-flex align-items-center">
                                                            <i className="lucide-hourglass me-2" style={{ width: '14px', height: '14px' }}></i>
                                                            <span className="text-muted small me-1">Hours:</span>
                                                            <span className="fw-medium small">{program.total_hours}</span>
                                                        </div>
                                                    )}
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                ) : (
                                    <tr>
                                        <td colSpan="5" className="text-center py-4">
                                            No completed programs found.
                                        </td>
                                    </tr>
                                )}
                            </tbody>
                        </table>
                    </div>
                )}
            </section>
        </>
    );
};

export default CompletedPrograms;
