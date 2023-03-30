import React, { useState, useEffect } from 'react'
import axios from 'axios'
import Card from './Card'
import { ReactSortable } from 'react-sortablejs'

export default function App () {
  const [list, setList] = useState([])
  const [loaded, setLoaded] = useState(false)
  const [saving, setSaving] = useState(false)

  const rootDom = document.getElementById('submenu-order-main')
  const getNonce = rootDom.getAttribute('data-get-nonce')
  const setNonce = rootDom.getAttribute('data-set-nonce')
  const slug = rootDom.getAttribute('data-slug')
  const type = rootDom.getAttribute('data-type')

  useEffect(() => {
    axios({
      method: 'POST',
      url: window.SubmenuOrderData.ajaxurl,
      data: `action=get_submenu_order&nonce=${getNonce}&slug=${slug}&type=${type}`
    }).then(res => {
      setList(res.data.list)
      setLoaded(true)
    })

    console.log('%cDIDMOUNT', 'background: #222; color: #bada55')
  }, [])

  const saveOrder = () => {
    setSaving(true)

    const newOrder = list.map(item => item.id)

    axios({
      url: window.SubmenuOrderData.ajaxurl,
      method: 'POST',
      data: `action=set_submenu_order&nonce=${setNonce}&slug=${slug}&type=${type}&list=` + JSON.stringify(newOrder)
    }).then(res => {
      console.log('%cSET', 'background: #00aada; color: #fff', res.data)
      setSaving(false)
    })
  }

  return (
    <>
      { loaded
        ? <>
          <div style={{ padding: '20px 0' }}>
            <button className='button button-primary' onClick={() => saveOrder()}>Save Order</button>
          </div>
          <ReactSortable list={list} setList={setList} className='ai-order-list'>
            { list.map((item, index) => <Card key={index} data={item} type={type} slug={slug} order={index + 1} />)}
          </ReactSortable>
        </>
        : <div style={{ padding: '20px 0' }}>Loading ...</div>
      }
      { saving && <div className="ai-order-saving-mask"></div> }
    </>
  )
}
