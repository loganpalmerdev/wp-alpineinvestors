import React from 'react'
import PropTypes from 'prop-types'

export default function Post ({ data: { title, image }, order }) {
  return (
    <div className="ai-order-item">
      <div className="ai-order-item--inner">
        <div className="ai-order-item--order">{order}</div>
        <div className="ai-order-item--image">
          <img src={image} />
        </div>
        <div className="ai-order-item--title">{title}</div>
      </div>
    </div>
  )
}

Post.propTypes = {
  data: PropTypes.shape({
    title: PropTypes.string.isRequired,
    image: PropTypes.string.isRequired
  }).isRequired,
  order: PropTypes.number.isRequired
}
