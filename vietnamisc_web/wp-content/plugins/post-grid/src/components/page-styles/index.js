

const { Component } = wp.element;
import { Button, Dropdown, } from '@wordpress/components'
import { Icon, styles, settings, link, linkOff, close, edit, pen } from "@wordpress/icons";
import { createElement, useCallback, memo, useMemo, useState, useEffect } from '@wordpress/element'
import apiFetch from '@wordpress/api-fetch';
import { useSelect } from "@wordpress/data";

import { __experimentalInputControl as InputControl, Popover, Spinner, PanelBody, PanelRow, ColorPalette, RangeControl, TextareaControl } from '@wordpress/components';
import PGStyles from '../../components/styles'

var myStore = wp.data.select('postgrid-shop');




function Html(props) {
  if (!props.warn) {
    return null;
  }
  const pgClipboard = localStorage.getItem("pgPageStyles");




  const [isLoading, setisLoading] = useState(false);
  const [pageCssObj, setpageCssObj] = useState({});
  const [pageStylsObj, setpageStylsObj] = useState(null);
  //var [breakPointX, setBreakPointX] = useState(myStore.getBreakPoint());




  const [copyPrams, setCopyPrams] = useState({ isCopied: false, isError: false, errorMessage: '' });
  const [pastePrams, setpastePrams] = useState({ init: false, isPasted: false, isError: false, errorMessage: '' });
  const [resetPrams, setresetPrams] = useState({ isReset: false, isError: false, errorMessage: '' });
  const [clipboard, setclipboard] = useState(pgClipboard == null ? [] : JSON.parse(pgClipboard));


  const postType = wp.data.select('core/editor').getCurrentPostType();
  const postId = wp.data.select("core/editor").getCurrentPostId();

  const { deviceType } = useSelect(select => {
    const { __experimentalGetPreviewDeviceType } = select('core/edit-post');

    return {
      deviceType: __experimentalGetPreviewDeviceType(),
    }
  }, []);



  useEffect(() => {


    generateCss();

    update_post();

  }, [pageCssObj]);


  // useEffect(() => {
  //   console.log('generateCss');

  //   if (pageStylsObj != null) {

  //     generateCss();
  //   }



  // }, []);




  useEffect(() => {


    localStorage.setItem("pgPageStyles", JSON.stringify(clipboard));


  }, [clipboard]);


  useEffect(() => {

    update_post();
    //localStorage.setItem("pgPageStyles", JSON.stringify(clipboard));
    generateCss();

  }, [pageStylsObj]);




  useEffect(() => {

    var postTypeX = postType;

    if (postType == 'post') {
      var postTypeX = 'posts';
    }
    if (postType == 'page') {
      var postTypeX = 'pages';
    }


    apiFetch({
      path: '/wp/v2/' + postTypeX + '/' + postId,
      method: 'POST',

    }).then((res) => {

      //console.log(typeof res.pgc_meta);
      // if (pageStylsObj == null) {

      // }
      setpageStylsObj((typeof res.pgc_meta == 'string') ? [] : res.pgc_meta)
      generateCss();

    });


  }, []);

  function update_post() {


    setisLoading(true);

    var postTypeX = postType;

    if (postType == 'post') {
      var postTypeX = 'posts';
    }
    if (postType == 'page') {
      var postTypeX = 'pages';
    }


    apiFetch({
      path: '/wp/v2/' + postTypeX + '/' + postId,
      method: 'POST',
      data: {
        "pgc_meta": pageStylsObj
      },
    }).then((res) => {

      setisLoading(false);
    });




  }




  function generateCss() {

    var selectorPrefix = ".editor-styles-wrapper ";

    var cssObj = {}

    console.log(pageStylsObj);



    pageStylsObj != null && pageStylsObj.map(item => {

      Object.entries(item).map(arg => {


        var sudoSrc = arg[0];
        var sudoArgs = arg[1];
        if (sudoSrc != 'options' && sudoArgs != null) {
          var selector = selectorPrefix + myStore.getElementSelector(sudoSrc, item.options.selector);
          var elemetnCssObj = myStore.generateElementCss(item, selector);



          Object.entries(arg[1]).map(x => {
            var attr = x[0];
            var cssPropty = myStore.cssAttrParse(attr);

            if (cssObj[selector] == undefined) {
              cssObj[selector] = {};
            }

            if (cssObj[selector][cssPropty] == undefined) {
              cssObj[selector][cssPropty] = {};
            }

            cssObj[selector][cssPropty] = x[1]
          })
        }


      })
    })




    myStore.generateBlockCss(cssObj, 'page-css', '');

  }



  function onChangeStyleItem(sudoScource, newVal, attr, obj, extra) {



    var path = [sudoScource, attr, deviceType]
    let objX = Object.assign({}, obj);
    const itemX = myStore.updatePropertyDeep(objX, path, newVal)

    var pageStylsObjX = [...pageStylsObj];

    pageStylsObjX[extra.index] = itemX

    // props.onChange(pageStylsObj);

    setpageStylsObj(pageStylsObjX)

    var elementSelector = myStore.getElementSelector(sudoScource, obj.options.selector);
    var cssPropty = myStore.cssAttrParse(attr);

    if (pageCssObj[elementSelector] == undefined) {
      pageCssObj[elementSelector] = {};
    }

    var cssPath = [elementSelector, cssPropty, deviceType]
    const cssObject = myStore.updatePropertyDeep(pageCssObj, cssPath, newVal)

    setpageCssObj(cssObject)




  }


  function onRemoveStyleItem(sudoScource, key, obj, extra) {

    var itemX = myStore.deletePropertyDeep(obj, [sudoScource, key, deviceType]);

    var pageStylsObjX = [...pageStylsObj];

    pageStylsObjX[extra.index] = itemX
    // props.onChange(pageStylsObj);
    setpageStylsObj(pageStylsObjX)


    var elementSelector = myStore.getElementSelector(sudoScource, obj.options.selector);
    var cssPropty = myStore.cssAttrParse(key);
    var cssObject = myStore.deletePropertyDeep(pageCssObj, [elementSelector, cssPropty, deviceType]);
    setpageCssObj(cssObject)



  }



  function onAddStyleItem(sudoScource, key, obj, extra) {

    const itemX = myStore.onAddStyleItem(sudoScource, key, obj)



    var pageStylsObjX = [...pageStylsObj];

    pageStylsObjX[extra.index] = itemX

    setpageStylsObj(pageStylsObjX)

  }


  var RemoveStyleObj = function ({ title, index }) {

    return (

      <>
        <span className='cursor-pointer hover:bg-red-500 hover:text-white px-1 py-1' onClick={ev => {


          var pageStylsObjX = [...pageStylsObj];

          var sdsd = pageStylsObjX.splice(index, 1)

          setpageStylsObj(pageStylsObjX)

        }}><Icon icon={close} /></span>
        <span className='mx-2'>{title}</span>
      </>




    )

  }



  return (

    <div className=''>


      <div className='my-3 flex items-center gap-2'>

        {isLoading && (

          <div>
            <Spinner />
          </div>

        )}

        <div className='bg-blue-500 my-3 cursor-pointer rounded-sm inline-block text-white px-3 py-1' onClick={ev => {

          var sdsd = pageStylsObj.concat({ options: { selector: ".selector" }, styles: {} })



          setpageStylsObj(sdsd)


        }}>Add</div>


        <div className='bg-blue-500 my-3 cursor-pointer rounded-sm inline-block text-white px-3 py-1'
          onClick={ev => {



            var styleStr = JSON.stringify(pageStylsObj);

            if (styleStr == null) {

              alert("Style is empty");

              return;

            }

            clipboard.push({ content: styleStr, label: Date.now() })
            setclipboard(clipboard);

            localStorage.setItem("pgPageStyles", JSON.stringify(clipboard));


            setCopyPrams({ ...copyPrams, isCopied: true })

            setTimeout(() => {
              setCopyPrams({ ...copyPrams, isCopied: false })
            }, 2000)

          }}
        >Copy Styles
          {copyPrams.isCopied && (
            <Popover position="bottom left">
              <div className='px-3 py-2'>Coppied</div>
            </Popover>
          )}



        </div>
        <div className='bg-blue-500 my-3 cursor-pointer rounded-sm inline-block text-white px-3 py-1'

        >
          <span onClick={ev => {



            ev.stopPropagation();

            setpastePrams({ ...pastePrams, init: !pastePrams.init })



          }}>
            Paste
            {clipboard.length != 0 && (
              <span className='bg-red-500 ml-2 rounded-sm text-white px-1'>{clipboard != null ? clipboard.length : 0}</span>
            )}




          </span>


          {pastePrams.init && (
            <Popover position="bottom left">

              <div className='w-52'>

                {clipboard.length == 0 && (
                  <div className='py-1 px-3'>Paste is empty!</div>
                )}



                {clipboard.map((item, index) => {

                  return (

                    <div className='flex items-center py-1 px-3 hover:bg-blue-200 justify-between'>



                      {(item.edit == null || item.edit == false) && (<div className='cursor-pointer' onClick={ev => {

                        var clipboardX = [...clipboard]

                        var content = clipboardX[index].content;

                        var pageStylsObjX = [...pageStylsObj];

                        console.log(content);
                        console.log(typeof content);

                        console.log(JSON.parse(content));

                        if (content.length == 0) {
                          alert("Style is empty");
                          return;
                        }


                        // pageStylsObjX[index].options.selector = value
                        setpageStylsObj(JSON.parse(content))


                      }} >{item.label}</div>)}
                      {item.edit && (
                        <InputControl
                          className="my-3"

                          placeholder=''
                          value={item.label}

                          onChange={(value) => {

                            var clipboardX = [...clipboard]

                            clipboardX[index].label = value;

                            setclipboard(clipboardX)

                          }}
                        />

                      )}


                      <div className='flex'>
                        <span className='hover:bg-blue-500 cursor-pointer hover:text-white py-1 px-1' onClick={ev => {
                          //item.edit = true;
                          var clipboardX = [...clipboard]
                          clipboardX[index].edit = !item.edit;

                          setclipboard(clipboardX)
                        }}><Icon icon={edit} /></span>

                        <span className='hover:bg-red-500 cursor-pointer hover:text-white py-1 px-1' onClick={ev => {
                          //item.edit = true;
                          var clipboardX = [...clipboard]
                          clipboardX.splice(index, 1);

                          setclipboard(clipboardX);

                        }}><Icon icon={close} /></span>
                      </div>


                    </div>

                  )

                })}

              </div>

            </Popover>
          )}



        </div>
      </div>






      {pageStylsObj == null && (

        <div>
          <Spinner />
        </div>

      )}



      {pageStylsObj != null && typeof pageStylsObj == 'object' && pageStylsObj.map((item, index) => {

        //var itemIndex = item[0];
        //var itemArgs = item[1];

        var options = item.options;

        return (

          <PanelBody title={<RemoveStyleObj title={options.selector} index={index} />} initialOpen={false}>

            <InputControl
              className="my-3"
              label=""
              help=""
              placeholder='.element-class or #element-id'
              value={options.selector}

              onChange={(value) => {
                // setopenAi({ ...openAi, promt: value })
                //item.options.selector = value


                var pageStylsObjX = [...pageStylsObj];
                pageStylsObjX[index].options.selector = value
                setpageStylsObj(pageStylsObjX)
              }}
            />

            <PGStyles extra={{ index: index }} obj={item} onChange={onChangeStyleItem} onAdd={onAddStyleItem} onRemove={onRemoveStyleItem} />

          </PanelBody>
        )

      })}



    </div>




  )

}


class PGPageStyles extends Component {

  constructor(props) {
    super(props);
    this.state = { showWarning: true };
    this.handleToggleClick = this.handleToggleClick.bind(this);
  }

  handleToggleClick() {
    this.setState(state => ({
      showWarning: !state.showWarning
    }));
  }



  render() {

    var {
      onChange,


    } = this.props;








    return (


      <Html onChange={onChange} warn={this.state.showWarning} />


    )
  }
}


export default PGPageStyles;