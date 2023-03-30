import React from 'react'
import PropTypes from 'prop-types'

export default function TaxonomyCard ({ data: { title }, order }) {
  return (
    <div className="ai-order-item">
      <div className="ai-order-item--inner">
        <div className="ai-order-item--order">{order}</div>
        <div className="ai-order-item--title">{title}</div>
      </div>
    </div>
  )
}

TaxonomyCard.propTypes = {
  data: PropTypes.shape({
    title: PropTypes.string.isRequired
  }),
  order: PropTypes.number.isRequired
}
