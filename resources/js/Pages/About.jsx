import { useState } from "react";
import Header from "../Components/Shared/Header.jsx";
import Footer from "../Components/Shared/Footer.jsx";
import Main from "../Components/ComponentPageCategory/Main.jsx";
import SearchPage from "./SearchPage";
export default function About({apps}) {
  const [searchResult, setSearchResult] = useState('');

    const handleSearchResult = (result) => {
        setSearchResult(result);
      };
  return (
    <>
    <Header onSearchResult={handleSearchResult}/>
    {
        searchResult === '' ? (
          <>
          <div className="container mt-20 h-screen items-center">
            this About
          </div>
          </>
        ) : (
          <SearchPage result={searchResult} apps={apps}/>
        )
      }
    <Footer/>
    </>
  )
}
