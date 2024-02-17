import React, { useEffect,useState } from 'react';
import AppCard from './App_Card';
import 'boxicons';

const SectionApp = ({ title, description, apps }) => {
  const [currentPage, setCurrentPage] = useState(1);
  const [appsCat, setAppsCat] = useState([])
  const appsPerPage = 6;
  const totalPages = Math.ceil(appsCat.length / appsPerPage);
  const nextApps = () =>   setCurrentPage((prevPage) => prevPage + 1);
  const previousApps = () => setCurrentPage((prevPage) => prevPage - 1 );
  const endIndex = currentPage * appsPerPage;
  const startIndex = endIndex - appsPerPage;
  const currentApps = appsCat.slice(startIndex, endIndex);
  useEffect(() => {
    const newApp = apps.filter((app) => app.categories === title);
    setAppsCat(newApp); 
    
  }, [apps, title])
  
  return (
    <div className="mx-auto py-10 px-4 sm:px-6 lg:px-8">
      <div className="flex flex-col sm:flex-row justify-between ">
        <div className="mb-6 sm:mb-0">
          <h2 className="text-3xl font-bold mb-5">{title}</h2>
          <h3 className="text-xl font-base mt-2 mb-10">{description}</h3>
        </div>
        <div className="w-full sm:w-1/3 flex justify-center items-start mt-4 sm:mt-0">
          <button
            className={`w-10 h-10 mr-1 rounded-full bg-slate-900 flex justify-center items-center hover:bg-slate-500 ${
              currentPage === 1 ? 'cursor-not-allowed' : 'cursor-pointer'
            }`}
            onClick={previousApps}
            disabled={currentPage === 1}
          >
            <box-icon name='chevron-left' type='solid' color='#f1eaea'></box-icon>
          </button>
          <button
            className={`w-10 h-10 rounded-full bg-slate-900 flex justify-center items-center hover:bg-slate-500 ${
              currentPage === totalPages ? 'cursor-not-allowed' : 'cursor-pointer'
            }`}
            onClick={nextApps}
            disabled={currentPage === totalPages}
          >
            <box-icon name='chevron-right' type='solid' color='#f1eaea'></box-icon>
          </button>
        </div>
      </div>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 mt-6  " >
        {currentApps.map((app, index) => (
          <AppCard key={index} slug={app.slug} title={app.name} description={app.description} logo={app.logo} reviews={app.nb_review} />
        ))}
      </div>
    </div>
  );
};

export default SectionApp;
