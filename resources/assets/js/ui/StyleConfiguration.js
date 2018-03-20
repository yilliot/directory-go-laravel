const BUTTON_WIDTH = '80px';
const BUTTON_HEIGHT = '60px';
const BUTTON_MARGIN = '3px';
const CATEGORY_HEIGHT = '80px';
const NUMBER_OF_BLOCK = 3;
const DEVICE_WIDTH = '1920px';
const DEVICE_HEIGHT = '1080px';
const INDEX_DISPLAY_POSITION_BOTTOM = '50px';
const INDEX_DISPLAY_POSITION_LEFT = '30px';
const INDEX_BLOCK_WIDTH = '350px';
const INDEX_BLOCK_MARGIN = '5px';
const INDEX_LEVEL_HEIGHT = '100px';

const Style = 
{
    rightblock:{
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
                    width: (parseInt(BUTTON_WIDTH) * NUMBER_OF_BLOCK) + parseInt(BUTTON_MARGIN) * 4 + 'px',
                    height: CATEGORY_HEIGHT,
                    wordWrap: 'normal',
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
                backgroundColor: '#666666',
                paddingLeft: parseInt(BUTTON_WIDTH) + parseInt(BUTTON_MARGIN) * 2 + 'px',
            },
            category:{
                style:{
                    width: (parseInt(BUTTON_WIDTH) * NUMBER_OF_BLOCK) + parseInt(BUTTON_MARGIN) * 4 + 'px',
                    height: CATEGORY_HEIGHT,
                    wordWrap: 'normal',
                }
            }
        }
    },
    display:{
        indexdisplay:{
            blocks: {
                style:{
                    display: 'flex',
                    flexDirection: 'row',
                    position: 'absolute',
                    bottom: INDEX_DISPLAY_POSITION_BOTTOM,
                    left: INDEX_DISPLAY_POSITION_LEFT,
                },
                block:{
                    style:{
                        display: 'flex',
                        flexDirection: 'column-reverse',
                        width: INDEX_BLOCK_WIDTH,
                        margin: INDEX_BLOCK_MARGIN
                    },
                    label: {
                    },
                    level: {
                        style: {
                            height: INDEX_LEVEL_HEIGHT,
                            display: 'flex',
                            justifyContent: 'space-between',
                        },
                        label: {},
                        zones: {
                            zone: {},
                        },
                    },
                    roof: {
                        style: {
                            display: 'flex',
                            justifyContent: 'space-between',
                        },
                        label: {},
                        comment: {}
                    }
                }
            },
            lists:{
                style: {
                    position: 'absolute',
                    left: '30px',
                    bottom: '30px',
                    height: '900px',
                    display: 'flex',
                    flexDirection: 'row',
                },
                list: {
                    style: {
                        width: '300px',
                    },
                    label: {},
                    row: {
                        blk: {},
                        lvl: {},
                        rm: {},
                    },
                }
            }
        }
    }
}

export default Style;