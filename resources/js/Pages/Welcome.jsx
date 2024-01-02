import { useState } from "react";
import Header from "../Components/Header.jsx";
import Footer from "../Components/Footer.jsx";
import Main from "../Components/Main.jsx";
import Slidebar from "../Components/Slidebar.jsx";




export default function Welcome() {
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

    return (
        <>
            <Header />
            <Slidebar />
            <Main />
            <Footer />
        </>
    );
}
