const BUTTONS_BOTTOM_POSITION = '40px';
const BUTTONS_RIGHT_POSITION = '40px';
const HEADING_LEFT_POSITION = '40px';
const HEADING_TOP_POSITION = '40px';
const BUTTON_WIDTH = '80px';
const BUTTON_HEIGHT = '60px';
const BUTTON_MARGIN = '3px';
const CATEGORY_HEIGHT = '80px';
const HEADING_LOCATION_WIDTH = '80px';
const HEADING_INDEX_WIDTH = '110px';
const HEADING_HEIGHT = '60px';
const SUBHEADING_LEFT_POSITION = '250px';
const SUBHEADING_TOP_POSITION = '50px';
const SUBHEADING_WIDTH = '300px';
const SUBHEADING_HEIGHT = '100px';
const NUMBER_OF_BLOCK = 3;
const DEVICE_WIDTH = '1920px';
const DEVICE_HEIGHT = '1080px';
const DISPLAY_LEFT_POSITION = '0px';
const DISPLAY_TOP_POSITION = '50px';

const Style = 
{
    buttons:{
        style:{
            position: 'absolute',
            display: 'flex',
            bottom: BUTTONS_BOTTOM_POSITION,
            right: BUTTONS_RIGHT_POSITION,
            zIndex: '4'
        },
        button:{
            style:{
                position: 'relative',
                width: BUTTON_WIDTH,
                height: BUTTON_HEIGHT,
                margin: BUTTON_MARGIN
            }
        }
    },
    rightblock:{
        style:{
            position: 'absolute',
            right: BUTTONS_RIGHT_POSITION,
            bottom: parseInt(BUTTONS_BOTTOM_POSITION) + parseInt(BUTTON_HEIGHT) + (parseInt(BUTTON_MARGIN) * 3) + 'px',
            width: (parseInt(BUTTON_WIDTH) * (NUMBER_OF_BLOCK + 1)) + (parseInt(BUTTON_MARGIN) * 6) + 'px',
            height: parseInt(DEVICE_HEIGHT) - (parseInt(BUTTONS_BOTTOM_POSITION) * 2) - parseInt(BUTTON_WIDTH) - (parseInt(BUTTON_MARGIN) * 4),
            margin: '0px ' + BUTTON_MARGIN,
            zIndex: '3',
        },
        levels:{
            style:{
                width: BUTTON_WIDTH,
                display: 'flex',
                flexDirection: 'column-reverse',
                position: 'absolute',
                height: '100%',    
                bottom: '0px'
            },
            level:{
                style:{
                    backgroundColor: '#a3a3a3',
                    color: '#666666',
                    width: BUTTON_WIDTH,
                    height: BUTTON_HEIGHT
                }
            }
        },
        categorys:{
            style:{
                width: (parseInt(BUTTON_WIDTH) * NUMBER_OF_BLOCK) + (parseInt(BUTTON_MARGIN) * 4) + 'px',
                position: 'absolute',
                height: '100%',
                bottom: '0px',
                right: '0px',
                overflow: 'scroll',
            },
            category:{
                style:{
                    width: (parseInt(BUTTON_WIDTH) * NUMBER_OF_BLOCK) + 'px',
                    height: CATEGORY_HEIGHT
                }
            }
        },
        indexs:{
            style:{
                width: (parseInt(BUTTON_WIDTH) * (NUMBER_OF_BLOCK + 1)) + (parseInt(BUTTON_MARGIN) * 6) + 'px',
                position: 'absolute',
                height: '100%',
                bottom: '0px',
                right: '0px',
                backgroundColor: '#666666'
            },
            category:{
                style:{
                    width: (parseInt(BUTTON_WIDTH) * NUMBER_OF_BLOCK) + 'px',
                    height: CATEGORY_HEIGHT
                }
            }
        }
    },
    heading:{
        style:{
            zIndex: 3,
            position: 'absolute',
            left: HEADING_LEFT_POSITION,
            top: HEADING_TOP_POSITION
        },
        block:{
            style:{
                width: HEADING_LOCATION_WIDTH,
                height: HEADING_HEIGHT
            }
        },
        level:{
            style:{
                width: HEADING_LOCATION_WIDTH,
                height: HEADING_HEIGHT
            }
        },
        index:{
            style:{
                width: HEADING_INDEX_WIDTH,
                height: HEADING_HEIGHT,
                backgroundColor: '#666666'
            }
        }
    },
    subheading:{
        style:{
            zIndex: 3,
            position: 'absolute',
            left: SUBHEADING_LEFT_POSITION,
            top: SUBHEADING_TOP_POSITION,
            width: SUBHEADING_WIDTH,
            height: SUBHEADING_HEIGHT
        }
    },
    display:{
        style:{
            width: parseInt(DEVICE_WIDTH) - parseInt(BUTTONS_RIGHT_POSITION) - parseInt(BUTTON_MARGIN * 8) - parseInt(BUTTON_WIDTH * 4) - parseInt(DISPLAY_LEFT_POSITION) + 'px',
            zIndex: 0,
            position: 'absolute',
            left: DISPLAY_LEFT_POSITION,
            top: DISPLAY_TOP_POSITION,
        }
    }
}

export default Style;