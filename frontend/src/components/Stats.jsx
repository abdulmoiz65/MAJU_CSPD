import React from 'react';
import './Stats.css';

const statsData = [
  {
    number: '200+',
    label: 'Staff Members',
    description: '',
  },
  {
    number: '150+',
    label: 'Faculty Members',
    description: '',
  },
  {
    number: '25+',
    label: 'Years of Excellence',
    description: '',
  },
  {
    number: '15+',
    label: 'Programs',
    description: '',
  },
];

const Stats = () => {
  return (
    <div className="stats-section">
      <div className="stats-grid">
        {statsData.map((stat, index) => (
          <div key={index} className="stat-item">
            <div className="stat-number">{stat.number}</div>
            <div className="stat-label">{stat.label}</div>
            <p className="stat-description">{stat.description}</p>
          </div>
        ))}
      </div>
    </div>
  );
};

export default Stats;