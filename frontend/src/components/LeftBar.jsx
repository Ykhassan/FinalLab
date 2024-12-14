import './LeftBar.css';

const  LeftBar  = () => {

    return (
        <div className='leftBar'> 
            <div className='header'>
                <h3>Menu</h3>
                <img src='   https://cdn-icons-png.flaticon.com/512/7711/7711100.png ' alt='menue-bar icon'/>
            </div>
            <div className='break'></div>
            <div className='taskCategory'>
                <div className='category'>
                    <img src="   https://cdn-icons-png.flaticon.com/512/6133/6133535.png " alt="" />
                    <h5>Upcoming</h5>
                </div>
                <div className='category'>
                    <img src="   https://cdn-icons-png.flaticon.com/512/3042/3042309.png " alt="" />
                    <h5>Done</h5>
                </div>
            </div>
            </div>
    )

};

export default LeftBar;

// files hierarchy
/*
Index.html
{main.jsx (ROOT element)
        App.jsx
            components }
*/
