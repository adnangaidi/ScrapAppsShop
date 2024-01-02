import { useEffect,useState } from "react";
import logo from "/resources/assets/logo.png";
import { FaTimes, FaBars } from "react-icons/fa";

const Header = () => {
  const [isMenuOpen, setIsMenuOpen] = useState(false);
  const [isHeaderFixed, setIsHeaderFixed] = useState(false);

  const toggleMenu = () => {
    setIsMenuOpen(!isMenuOpen);
  };

  const handleScroll = () => {
    const scrollPosition = window.scrollY;
    setIsHeaderFixed(scrollPosition > 0);
  };

  useEffect(() => {
    window.addEventListener("scroll", handleScroll);
    return () => {
      window.removeEventListener("scroll", handleScroll);
    };
  }, []);

  const navItems = [
    { link: "Shopify Apps", path: "home" },
    { link: "Catigorie", path: "catigorie" },
    { link: "About", path: "about" },
    { link: "contact", path: "contact" },
  ];

  return (
    <>
      <nav className={`bg-gray-300 md:px-14 p-4 max-w-screen-2xl border-b mx-auto  text-primary ${
          isHeaderFixed ? "fixed top-0 right-0 left-0" : ""
        }`}>
        <div className="text-lg container mx-auto flex justify-between items-center font-medium ">
          <div className="flex items-center space-x-14 text-primary ">
            <a
              href="/"
              className="font-semibold flex items-center space-x-3 text-primary"
            >
              <img
                src={logo}
                alt=""
                className="w-25 h-11 inline-block items-center"
              />
            </a>

            <ul
              className={`space-x-12 pt-3 ${
                isMenuOpen ? "hidden md:flex" : "hidden md:flex"
              }`}
            >
              {navItems.map(({ link, path }) => (
                <a
                  key={link}
                  href={path}
                  className="block hover:text-gray-400"
                >
                  {link}
                </a>
              ))}
            </ul>
          </div>

          <div
            className={`items-center space-x-10 text-primary ${
              isMenuOpen ? "hidden  flex" : "flex"
            }`}
          >
            <button
              className={`mt-1 bg-secondary py-2 px-4 hidden md:flex transition-all duration-300 rounded hover:text-white hover:bg-indigo-600`}
            >
              Signup
            </button>
          </div>

          <div className="md:hidden">
            <button
              onClick={toggleMenu}
              className="text-white  focus:outline-none focus:text-gray-300 "
            >
              {isMenuOpen ? (
                <FaTimes className="w-6 h-6 text-primary" />
              ) : (
                <FaBars className="w-6 h-6 text-primary " />
              )}
            </button>
          </div>
        </div>
      </nav>

      {/* Mobile Menu */}
      {isMenuOpen && (
        <div className="text-xl space-y-4 px-4 pt-20 pb-5 bg-secondary fixed top-0 right-0 left-0">
          {navItems.map(({ link, path }) => (
            <a
              key={link}
              href={path}
              className="block text-white hover:text-gray-400"
              onClick={toggleMenu}
            >
              {link}
            </a>
          ))}
        </div>
      )}
    </>
  );
};

export default Header;
